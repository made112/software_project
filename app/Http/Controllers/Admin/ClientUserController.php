<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Clients\StoreClientsRequest;
use App\Http\Requests\Admin\Clients\StoreClientUserReqest;
use App\Http\Requests\Admin\Clients\UpdateClientUserRequest;
use App\Models\City;
use App\Models\Clients;
use App\Models\ClientUser;
use App\Models\ClientUserProduct;
use App\Models\Country;
use App\Traits\FileUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ClientUserController extends Controller
{
    use FileUpload;
    /**
     * get a table of users who is related to specific client
     *
     * @param mixed $clientId
     *
     * @return JsonResponse
     *
     */
    public function index($clientId): JsonResponse
    {
        $client = Clients::findOrFail($clientId);
        $data = [
            "status" => true,
            'data' => view('admin.clients.users.table', [
                'users' => $client->users()->tableFilter()->get(),
                'client' => $client
            ])->render()
        ];

        return response()->json($data);
    }

    /**
     * show create new user form
     *
     * @param mixed $clientId
     *
     * @return View
     *
     */
    public function create($clientId): View
    {
        $client = Clients::findOrFail($clientId);
        $countries = Country::where('status', 1)->get();
        $cities = City::where('status', true)->whereHas('country', function ($query) {
            return $query->where('country_code', '966');
        })->get();
        $gender = array('1'=>'Male','2'=>'Female');
        return view('admin.clients.users.create')
            ->with('client', $client)
            ->with('countries', $countries)
            ->with('cities', $cities)
            ->with('gender', $gender);
    }

    /**
     * store users and assign products
     *
     * @param StoreClientUserReqest $request
     * @param mixed $clientId
     *
     * @return JsonResponse
     *
     */
    public function store(StoreClientUserReqest $request, $clientId): JsonResponse
    {
        $data = $request->validated();
        $client = Clients::findOrFail($clientId);
        $file = null;
        if ($request->has('image')) {
            $file = $this->uploadFile($request->file("image"));
        }

        $data['photo'] = $file ?? (new ClientUser())->getPhotoAttribute(null);
        $user = $client->users()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'job_title' =>  $data['job_title'],
            'email' =>  $data['email'],
            'phone_number' =>  $data['phone_number'],
            'status' =>  $data['status'],
            'photo' =>  $file,
            'country_id' =>  $data['country_id'],
            'mobile_country' =>  $data['country_code'],
            'gender' =>  $data['gender'],
        ]);
        $user->products()->attach($data['products']);

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    /**
     * soft delete user
     *
     * @param mixed $clientId
     * @param mixed $userId
     *
     * @return JsonResponse
     *
     */
    public function delete($clientId, $userId): JsonResponse
    {
        ClientUser::destroy($userId);

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    /**
     * show edit client user form
     *
     * @param mixed $clientId
     * @param mixed $userId
     *
     * @return View
     *
     */
    public function edit($clientId, $userId): View
    {
        $client = Clients::findOrFail($clientId);
        $user = ClientUser::findOrFail($userId);
        $countries = Country::where('status', 1)->get();
        $productsIds = $user->products->pluck('id')->toArray();
        $cities = City::where('status', true)->whereHas('country', function ($query) use ($user) {
            return $query->where('id', $user->country_id);
        })->get();
        $gender = array('1'=>'Male','2'=>'Female');
        $country = Country::where('id',$user->country_id)->first();
        return view('admin.clients.users.edit')
            ->with('client', $client)
            ->with('user', $user)
            ->with('countries', $countries)
            ->with('productsIds', $productsIds)
            ->with('cities', $cities)
            ->with('gender', $gender)
            ->with('country', $country);
    }

    public function update($clientId, $userId, UpdateClientUserRequest $request): JsonResponse
    {

        $data = $request->validated();
        $client = Clients::findOrFail($clientId);
        $user = ClientUser::findOrFail($userId);
        $file = null;
        if ($request->has('image')) {
            $file = $this->uploadFile($request->file("image"));
        }
        if (!is_null($file)) {
            $data['photo'] = $file;
        }
        $data['mobile_country'] =   $data['country_code'];

        $user->update($data);
        $user->products()->sync($data['products']);

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    public function updateStatus(Request $request,$clientId,$userId){
        // return $request;
        $client = Clients::findOrFail($clientId);
        $user = ClientUser::findOrFail($userId);
        if(!$client){
            return response()->json(['status' => false, 'data' => __('lang.client_not_found')]);
        }
        if(!$user){
            return response()->json(['status' => false, 'data' => __('lang.user_not_found')]);
        }
        if($user->status == 1){
            $user->status = 2;
        }else{
            $user->status = 1;
        }
        $saved = $user->save();
        if(!$saved){
            return response()->json(['status' => false, 'data' => __('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }
}
