<?php


namespace App\Http\Controllers\Admin;

use App\Events\EditProductEvent;
use App\Events\NewProductToAdminEvent;
use App\Models\Clients;
use App\Models\ClientUser;
use App\Models\ClientUserProduct;
use App\Models\Products;
use App\Models\Setting;
use App\Models\Products as MyModel;
use App\Models\License;
use App\Models\Notifications;
use App\Models\ClientsProducts;
use App\Models\User;
use App\Models\Versions;
use App\Notifications\AddNewVersionToProductNotification;
use App\Notifications\NewProductNotification;
use App\Notifications\NewProductToAdminNotification;
use Freshdesk\Resources\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\Products\StoreProductsRequest;
use App\Http\Requests\Admin\Products\UpdateProductsReqeust;
use App\Http\Requests\Admin\Products\AddToClientRequest;
use App\Models\User_Permission;
use DB;
use App\Models\Country;

class ProductController extends AdminController
{

    protected $model;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    //////////////////////////////////////////////

    public function index(Request $request)
    {
        $products = $this->model->filter($request->all());
        if ($request->from) {
            $products = $products->where('created_at', '>=', $request->from);
        }
        if ($request->to) {
            $products = $products->where('created_at', '<=', $request->to);
        }
        $products = $products->with('last_version')->select('id', 'name', 'product_id', 'status', 'created_at')->orderBy('id', 'desc')->paginate(10);
        $data['products'] = $products;
        if ($request->ajax()) {
            return view('admin.products.table-data', compact('data'))->render();
        }
        return view('admin.products.index', compact('data'));
    }

    public function create(Request $request)
    {
        $product_id = \Str::random(7);
        return view('admin.products.create', compact('product_id'));
    }

    public function edit(Request $request, $id)
    {
        $products = MyModel::where('id', $id)->first();
        if (!$products) {
            abort(404);
        }
        return view('admin.products.edit', compact(['products', 'id']));
    }

    public function add(StoreProductsRequest $request)
    {
        $product_id = $request->get('product_id');
        $name = $request->get('name');
        $status = $request->get('status');
        $gitlab_link = $request->get('gitlab_link');
        $gitlab_username = $request->get('gitlab_username');
        $gitlab_access_token = $request->get('gitlab_access_token');
        if (isset($request['download_update'])) {
            $request['download_update'] = 1;
        } else {
            $request['download_update'] = 0;
        }

        $product = new MyModel();
        $product_exists = $product->checkProduct(1, $name);

        if ( $product_exists > 0 ) {
            return response()->json(['status' => false, 'data' => trans('lang.product_exists')]);
        }



        $details = $request->get('details');
        $validated = $request->validated();
        $validated['user_id'] = \Auth::user()->id;
        dd($validated);
        $saved =  MyModel::create($validated);



        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        // Start Send Email Notification To Super Admin
        $admin = Setting::where('id', 1)->first();

        $admin->notify( new NewProductToAdminNotification($admin, $saved) );
        // End Send Email Notification To Super Admin

        // Start Send Email To Auth User
        $product = Products::where('id', $saved->id)->first();
        $user = $product->user;
        $product->user->notify(new NewProductNotification($product, $user));
        // End Send Email To Auth User

        return response()->json(['status' => true, 'data' => trans('lang.success'), 'product' => $saved]);
    }


    public function update(UpdateProductsReqeust $request)
    {

        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        $product_id = $request->get('product_id');
        $name = $request->get('name');
        $status = $request->get('status');
        if (isset($request['download_update'])) {
            $request['download_update'] = 1;
        } else {
            $request['download_update'] = 0;
        }
        $product_details = $request->get('product_details');

        $validated = $request->validated();

        // Send Email To User After Updated
        event(new EditProductEvent($obj));

        $saved =  $obj->update($validated);
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        $version = Versions::where('product_id', $id)->first();
        if ($version) {
            return response()->json(['status' => false, 'data' => trans('lang.cannot_delete_has_version')]);
        }
        $notifications = Notifications::where('product_id', $id)->first();
        if ($notifications) {
            return response()->json(['status' => false, 'data' => trans('lang.cannot_delete_has_notifications')]);
        }
        $license = License::where('product_id', $id)->first();
        if ($license) {
            return response()->json(['status' => false, 'data' => trans('lang.cannot_delete_has_license')]);
        }
        $deleted = $obj->delete();
        if (!$deleted) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function add_to_client(AddToClientRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = \Auth::user()->id;
        $saved =  ClientsProducts::create($validated);
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        $product = MyModel::where('id', $request->product_id)->first();
        return response()->json(['status' => true, 'data' => trans('lang.success'), 'product' => $product]);
    }

    public function select(Request $request)
    {
        $term = $request->get('term');
        $client_id = $request->get('client_id');

        $data = MyModel::query();
        $i = 0;
        $data = $data->where(function ($query) use ($term) {
            $query->where('name', 'like', '%' . str_replace(' ', "%", $term) . '%');
        });

//        if( $client_id ) {
//            $data = $data->whereHas('clients_products', function ($q) use ($client_id) {
//                $q->where('client_id', $client_id);
//            });
//        }

        $data = $data->where('status', 1)->limit(5)->get(['id', 'name as text']);
        echo json_encode($data);
        // }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        if ($obj->status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        $obj->update([
            'status' => $status
        ]);
        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    public function getContact(Request $request)
    {
        //        $product = Products::query()->where('id', $request->product_id)->with('clients')->get();
        $clients = ClientUser::query()->where('client_id', $request->client_id)->get(); // Client Users

        $data = array();

        foreach ($clients as $client) {
            $data[] = ClientUserProduct::query()
                ->where('product_id', $request->product_id)
                ->where('client_user_id', $client->id)
                ->with('user')
                ->get();
        }

        return response()->json([
            'clients' => $data,
        ]);
    }

    public function checkClients(Request $request)
    {
        $clients = ClientsProducts::where('product_id', $request->product_id)->count();


        $product = Products::where('id', $request->product_id)->first();




        return response()->json([
            'count' => $clients
        ]);

    }

    public function getClients(Request $request)
    {

        $productId = $request->input('product_id');

        $product = Products::find($productId);


        return response()->json([
           'data' => $product->clients()->get( ['clients.id', 'clients.name as text'])
        ]);

//        $clients_product = ClientsProducts::where('product_id', $request->product_id)->get();
//        $data = [];
//
//        foreach( $clients_product as $client ) {
//            $data[] = Clients::query()->where('id', $client->client_id)->get(['id', 'name as text']);
//        }
//
//
//        echo json_encode($data);
    }
}
