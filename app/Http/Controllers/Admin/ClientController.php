<?php


namespace App\Http\Controllers\Admin;

use App\Events\NewCompanyRegisteredEvent;
use App\Events\UpdateCompanyEvent;
use App\Listeners\NewCompanyRegistered;
use App\Models\Setting;
use App\Models\Clients as MyModel;
use App\Notifications\AddNewManagerToCompanyNotification;
use App\Notifications\NewClientNotification;
use App\Notifications\NewClientToManagerNotification;
use App\Notifications\NewCompanyRegisteredNotification;
use App\Notifications\NewLicenseToManagerNotification;
use App\Notifications\UpdateCompanyToManagerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Mpclarkson\Laravel\Freshdesk\Facades\Freshdesk;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\Clients\StoreClientsRequest;
use App\Http\Requests\Admin\Clients\UpdateClientsReqeust;
use App\Models\ApiCall;
use App\Models\License;
use App\Models\Products;
use App\Models\ProjectsManager;
use App\Models\ClientUserProduct;
use App\Models\City;
use App\Models\Clients;
use App\Models\User;
use App\Models\ClientsProducts;
use App\Models\ClientUser;
use App\Models\User_Permission;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Traits\FileUpload;

class ClientController extends AdminController
{

    protected $model;
    use FileUpload;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    //////////////////////////////////////////////

    public function index(Request $request)
    {
        $lang = \App::getLocale();
        $clients = $this->model->filter($request->all());

        if ($request->from) {
            $clients = $clients->where('created_at', '>=', $request->from);
        }
        if ($request->to) {
            $clients = $clients->where('created_at', '<=', $request->to);
        }
        $clients = $clients->select('id', 'name', 'email', 'client_id', 'image', 'phone_number', 'country_code', 'status')->orderBy('id', 'desc')->paginate(10);
        $data['clients'] = $clients;
        $data['counrty'] = Country::where("name_$lang", '!=', '')->where('status', 1)->orderBy("name_$lang", 'asc')->get(["name_$lang as name", 'id', 'country_code']);
        if ($request->ajax()) {
            return view('admin.clients.table-data', compact('data'))->render();
        }
        return view('admin.clients.index', compact('data'));
    }

    public function create(Request $request)
    {
        $client_id = \Str::random(7);
        $lang = \App::getLocale();
        $data['counrty'] = Country::where("name_$lang", '!=', '')->where('status', 1)->orderBy("name_$lang", 'asc')->get(["name_$lang as name", 'iso2', 'id', 'country_code']);
        $data['users'] = User::get(['id', 'name']);
        $data['cities'] = City::where('status', true)->whereHas('country', function ($query) {
            return $query->where('country_code', '966');
        })->get();

        return view('admin.clients.create', compact(['client_id', 'data']));
    }

    public function edit(Request $request, $id)
    {
        $clients = MyModel::with('projects_manager')->where('id', $id)->first();

        if (!$clients) {
            abort(404);
        }
        $lang = \App::getLocale();
        $data['counrty'] = Country::where("name_$lang", '!=', '')->where('status', 1)->orderBy("name_$lang", 'asc')->get(["name_$lang as name", 'id', 'iso2', 'country_code']);
        $country = Country::where('id', $clients->country_id)->first();
        $data['users'] = User::get(['id', 'name']);
        $data['cities'] = City::where('status', true)->whereHas('country', function ($query) use ($clients) {
            return $query->where('id', $clients->country_id);
        })->get();
        return view('admin.clients.edit', compact(['clients', 'id', 'data', 'country']));
    }

    public function add(StoreClientsRequest $request)
    {
        $image = $request->file('image');
        $name = $request->get('name');

        $validated = $request->validated();
        $project_manager = $request->get('project_manager');

        if ($image) {
            $validated['image'] = $this->uploadFile($image);
        }
        $validated['user_id'] = \Auth::user()->id;

        $client = new MyModel();

        $client_exists = $client->checkCompany(1, $name);

        if ( $client_exists > 0 ) {
            return response()->json(['status' => false, 'data' => trans('lang.client_exists')]);
        }


        DB::beginTransaction();
        try {

            $saved =  MyModel::create($validated);
            if (!$saved) {
                return response()->json(['status' => false, 'data' => trans('lang.error')]);
            }

            if ($project_manager) {
                foreach ($project_manager as $proj) {
                    $proj_m = ProjectsManager::create(['client_id' => $saved->id, 'manager_id' => $proj, 'user_id' => \Auth::user()->id]);
                }
            }

            DB::commit();

            $client = MyModel::orderBy('created_at', 'desc')->first();

            $setting = Setting::where('id', 1)->first();

            event(new NewCompanyRegisteredEvent($client, $setting));

            return response()->json(['status' => true, 'data' => trans('lang.success')]);
        } catch (\Exception $e) {
            DB::rollback();
        }
        return response()->json(['status' => false, 'data' => trans('lang.error')]);
    }

    public function update(UpdateClientsReqeust $request)
    {
        $id = $request->get('id');
        $image = $request->file('image');

        $obj = MyModel::where('id', $id)->first();

        $project_manager = $request->get('project_manager'); // 13, 12

        /**
         * ? Start New Manager Notification
         * ! Functionality ( Compare Between Previous Managers And New Managers From Request )
         */

        $obj_managers = collect($obj->projects_manager);
        $previous_manager = array();
        foreach ($obj_managers as $manager) {
            $previous_manager[] = $manager->manager_id; // 13
        }
        $managers = array_diff($project_manager, $previous_manager);

        foreach ($managers as $key => $value) {
            $users = User::query()->where('id', $value)->get();

            foreach ($users as $user) {
                Notification::send($user, new AddNewManagerToCompanyNotification($user));
            }
        }
        // End New Manager Notifications

        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        $validated = $request->validated();
        if ($image) {
            $validated['image'] = $this->uploadFile($image);
        }
        DB::beginTransaction();
        try {

            ProjectsManager::where('client_id', $id)->delete();
            $saved =  $obj->update($validated);
            if (!$saved) {
                return response()->json(['status' => false, 'data' => trans('lang.error')]);
            }
            if ($project_manager) {
                foreach ($project_manager as $proj) {
                    $proj_m = ProjectsManager::create(['client_id' => $obj->id, 'manager_id' => $proj, 'user_id' => \Auth::user()->id]);
                }
            }

            DB::commit();

            // Send Emails After Updated
            event(new UpdateCompanyEvent($obj));


            return response()->json(['status' => true, 'data' => trans('lang.success')]);
        } catch (\Exception $e) {
            DB::rollback();
        }
        return response()->json(['status' => false, 'data' => trans('lang.error')]);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        $license = License::where('client_id', $id)->first();
        if ($license) {
            return response()->json(['status' => false, 'data' => trans('lang.can_delete')]);
        }

        $deleted = $obj->delete();
        if (!$deleted) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function select(Request $request)
    {
        $term = $request->get('term');
        $product_id = $request->get('product_id');
        // if ($term) {
        $data = MyModel::query();
        $i = 0;
        $data = $data->where(function ($query) use ($term) {
            $query->where('name', 'like', '%' . str_replace(' ', "%", $term) . '%')->Orwhere('client_id', 'like', '%' . str_replace(' ', "%", $term) . '%');
        })->where('status', 1);

        $data = $data->get(['id', 'name as text']);
        echo json_encode($data);
    }


    /**
     * show client profile
     *
     * @param Clients $client
     *
     * @return View
     *
     */
    public function show(Request $request, int $id): View
    {
        $client = Clients::with(['projects_manager.manager', 'products.supportUsers' => function ($q) use ($id) {
            $q->where('client_id', '=', $id);
        }, 'products.clientUserProduct.user', 'products.licenses'
        => function ($q) use ($id) {
            $q->where('client_id', '=', $id); // '=' is optional
        }])->withCount('users')
            ->findOrFail($id)->load(['users']);

        $licenses = $client->licenses()->whereYear('date', now())->groupBy('date_group')->get([
            DB::raw('DATE_FORMAT(date , \'%b\') as date_group'),
            DB::raw('sum(price) as price')
        ])->toArray();

        if (count($licenses) <= 1) {
            array_unshift($licenses, ['date_group' => 'Jan', 'price' => 0]);
        }

        $countries = Country::where('status', 1)->get();
        $cities = City::where('status', true)->whereHas('country', function ($query) use ($client) {
            return $query->where('id', $client->country_id);
        })->get();


        $activations = $client->activations()->groupBy('date')->get([
            DB::raw('DATE_FORMAT(created_at , \'%b\') as date'),
            DB::raw('count(*) as count')
        ])->toArray();

        if (count($activations) <= 1) {
            array_unshift($activations, ['date' => 'Jan', 'count' => 0]);
        }

        $top_api_call = \DB::table('api_calls')->where('client_id', $id)->whereRaw('`function` is not null')->whereNull('deleted_at')->selectRaw('count(id) as cnt,`function`,`status`')->groupByRaw('`function`,`status`')->orderByRaw('`cnt` desc')->get();


        $data['activation'] = ApiCall::where('function', ApiCall::ActivateLicense)->where('client_id', $id)->count();
        $data['downloads'] = ApiCall::where('function', ApiCall::UpdateDownloads)->where('client_id', $id)->count();
        $data['api_call'] = ApiCall::where('client_id', $id)->count();
        $data['products'] = Products::with('supportUsers')->whereHas('clients_products', function ($query) use ($id) {
            $query->where('client_id', $id);
        })->get();

        $gitlab = null;
        foreach ($data['products'] as $product) {
            $gitlab = ClientsProducts::where('client_id', $client->id)->where('product_id', $product->id)->first();
        }

        // $data['update_download']
        $data['update_download'] = ApiCall::with(['client', 'version', 'product'])->where('client_id', $id)->where('function', ApiCall::UpdateDownloads)->select('id', 'status', 'errors', 'validation_error', 'client_id', 'version_id', 'product_id', 'created_at')->orderBy('created_at', 'desc')->take(10)->get();
        $data['update_download_all'] = ApiCall::where('function', ApiCall::UpdateDownloads)->where('client_id', $id)->count();
        $data['update_download_today'] = ApiCall::where('function', ApiCall::UpdateDownloads)->where('client_id', $id)->whereRaw('date(created_at) = CURDATE()')->count();
        $data['update_download_yesterday'] = ApiCall::where('function', ApiCall::UpdateDownloads)->where('client_id', $id)->whereRaw('date(created_at) = (CURDATE() - INTERVAL 1 DAY)')->count();
        $data['update_download_pct_today'] = ($data['update_download_today'] - $data['update_download_yesterday']);
        $data['update_download_pct_today'] = ($data['update_download_pct_today'] / ($data['update_download_today'] ? $data['update_download_today'] : 1)) * 100;

        $data['update_download_weekly'] = ApiCall::where('function', ApiCall::UpdateDownloads)->whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 1 WEEK) and CURDATE()')->where('client_id', $id)->count();
        $data['update_download_prev_last_weekly'] = ApiCall::where('function', ApiCall::UpdateDownloads)->whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 2 WEEK) and date_sub(CURDATE(),INTERVAL 1 WEEK)')->where('client_id', $id)->count();

        $data['update_download_pct'] =  ($data['update_download_weekly'] - $data['update_download_prev_last_weekly']);
        $data['update_download_pct'] = ($data['update_download_pct'] / ($data['update_download_weekly'] ? $data['update_download_weekly'] : 1)) * 100;


        $data['api_call_weekly'] = ApiCall::whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 1 WEEK) and CURDATE()')->where('client_id', $id)->count();
        $data['api_call_prev_last_weekly'] = ApiCall::whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 2 WEEK) and date_sub(CURDATE(),INTERVAL 1 WEEK)')->where('client_id', $id)->count();

        $data['api_call_weekly_pct'] =  ($data['api_call_weekly'] - $data['api_call_prev_last_weekly']);
        $data['api_call_weekly_pct'] = ($data['api_call_weekly_pct'] / ($data['api_call_weekly'] ? $data['api_call_weekly'] : 1)) * 100;


        $data['api_call_today'] = ApiCall::where('client_id', $id)->whereRaw('date(created_at) = CURDATE()')->count();
        $data['api_call_yesterday'] = ApiCall::where('client_id', $id)->whereRaw('date(created_at) = (CURDATE() - INTERVAL 1 DAY)')->count();
        $data['api_call_pct_today'] = ($data['api_call_today'] - $data['api_call_yesterday']);
        $data['api_call_pct_today'] = ($data['api_call_pct_today'] / ($data['api_call_today'] ? $data['api_call_today'] : 1)) * 100;

        if ($request->ajax()) {
            return view('admin.clients.product-data')
                ->with('countries', $countries)
                ->with('licensesData', $licenses)
                ->with('activationsData', $activations)
                ->with('client', $client)
                ->with('cities', $cities)
                ->with('top_api_call', $top_api_call)
                ->with('gitlab', $gitlab)
                ->with('data', $data)
                ->render();
        }
            return view('admin.clients.show')
                ->with('countries', $countries)
                ->with('licensesData', $licenses)
                ->with('activationsData', $activations)
                ->with('client', $client)
                ->with('cities', $cities)
                ->with('top_api_call', $top_api_call)
                ->with('gitlab', $gitlab)
                ->with('data', $data);

    }


    public function getChartData(Clients $client)
    {
        $data = [
            'license_chart_labels' => array_keys($client->licenses()->orderBy('date')->get()->groupBy(function ($license) {
                // return date('m', strtotime($license->date));
                return Carbon::parse($license->date)->format('M');
            })->toArray()),
            'license_chart_values' =>  array_values($client->licenses()->orderBy('date')->get()->groupBy(function ($license) {
                // return date('m', strtotime($license->date));
                return Carbon::parse($license->date)->format('M');
            })->map(function ($licenses) {
                return $licenses->sum('price');
            })->toArray())
        ];
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        $obj->update([
            'status' => !$obj->status
        ]);
        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    public function productsLicenses(Request $request)
    {
        $id = $request->get('id');
        $client_id = $request->get('client_id');
        $product_id = $request->get('product_id');

        $licenses = License::with('license_use')->where('product_id', $product_id)->where('client_id', $client_id);
        if ($id == 1) {
            $licenses = $licenses->where('usage', 1)->where('date', '>=', date('Y-m-d'));
        } elseif ($id == 2) {
            $licenses = $licenses->where('usage', 0)->where('date', '>=', date('Y-m-d'));
        } elseif ($id == 3) {
            $licenses = $licenses->where('date', '<', date('Y-m-d'));
        } elseif ($id == 4) {
            $licenses = $licenses->where('block', 1);
        }
        $licenses = $licenses->select('id', 'product_id', 'client_id', 'license_code', 'days', 'date')->get();
        return response()->json(['status' => true, 'data' => $licenses]);
    }

    public function productMange(Request $request, $client_id, $product_id)
    {
        $client = MyModel::with('projects_manager')->where('id', $client_id)->first();
        if (!$client) {
            abort(404);
        }
        $product = Products::find($product_id);
        if (!$product) {
            abort(404);
        }
        $last_licenses =  License::where('product_id', $product_id)->where('client_id', $client_id)->first();
        $active_licenses = License::where('product_id', $product_id)->where('client_id', $client_id)->where('usage', 1)->where('date', '>=', date('Y-m-d'))->count();
        $inactive_licenses = License::where('product_id', $product_id)->where('client_id', $client_id)->where('usage', 0)->where('date', '>=', date('Y-m-d'))->count();
        $expired_licenses = License::where('product_id', $product_id)->where('client_id', $client_id)->where('date', '<', date('Y-m-d'))->count();
        $blocked_licenses = License::where('product_id', $product_id)->where('client_id', $client_id)->where('block', 1)->count();
        $managers = ProjectsManager::where('client_id', $client_id)->count();
        $contacts = ClientUserProduct::whereIn('client_user_id', ClientUser::where('client_id', $client_id)->pluck('id')->ToArray())->where('product_id', $product_id)->count();
        $all_licenses =  License::where('product_id', $product_id)->where('client_id', $client_id)->orderBy('id', 'desc')->get();

        return view('admin.clients.product-manage', compact('client', 'all_licenses', 'contacts', 'managers', 'last_licenses', 'product', 'active_licenses', 'inactive_licenses', 'expired_licenses', 'blocked_licenses'));
    }

    public function getEmail(Request $request)
    {
        $client = Clients::where('id', $request->client_id)->first();
        return response()->json([
            'client' => $client,
        ]);
    }

    public function gitlab($client_id, $product_id)
    {
        $client_product = ClientsProducts::query()->where('client_id', $client_id)->where('product_id', $product_id)->first();

        return view('admin.clients.gitlab', compact('client_product'));
    }

    public function updateGitLab(Request $request, $id)
    {
        $client_product = ClientsProducts::findOrFail($id);

        $request->validate([
            'gitlab_username' => ['nullable'],
            'gitlab_link' => ['nullable'],
            'gitlab_access_token' => ['nullable'],
        ]);

        $client_product->update([
            'gitlab_username' => $request->gitlab_username,
            'gitlab_link' => $request->gitlab_link,
            'gitlab_access_token' => $request->gitlab_access_token,
        ]);

        return redirect()->back();
    }

    public function clientProduct()
    {

    }

}
