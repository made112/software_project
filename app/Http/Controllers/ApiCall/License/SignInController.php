<?php

namespace App\Http\Controllers\ApiCall\License;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\Clients;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use App\Models\License;
use DB;
use App\Models\LicensesUse;
use App\Models\Versions;
use App\Models\ClientsProducts;
use App\Services\License\HashService;
use Illuminate\Support\Facades\Validator;

class SignInController  extends Controller
{

    protected $model;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    public function signIn(Request $request)
    {
        $client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $ip = \Request::ip();
        $status = true;
        $errors = array();
        $product_id = null;
        $cl_id = null;
        $client = Clients::where('client_id', $client_id)->first();
        $cl_id = $client->id;
        $p_id = null;
        $license = License::where('license_code', $license_code)->first();


        $validator = Validator::make($request->all(), [
            'encrypted_data' => ['required'],
            'public_key' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $validator->errors()], 422);
        }

        $bodyData = $validator->validated();

        $unhash = (new HashService)->SSLDecrypt($bodyData['encrypted_data'], $bodyData['public_key']);

        $validator = Validator::make($unhash, [
            'ip' => ['required'],
            'client_id' => ['required'],
            'uuid' => ['required'],
            'macaddress' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $validator->errors()], 422);
        }


        $ip = $unhash['ip'];


        if (!$license) {
            $status = false;
            $errors[] = trans('lang.license_code_not_found');
        } else {
            if ($license->client_id != $cl_id) {
                $status = false;
                $errors[] = trans('lang.license_code_does_not_belong_to_client');
            }
            $p_id = $license->product_id;
        }


        if ($status == false) {
            $status_data = 0;
            $errors = implode(",", $errors);
            $apiData = MyModel::create(['product_id' => $p_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'validation_error' => $errors, 'function' => MyModel::SignIn]);
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
        }

        if ($license->type == 1) {
            $check_count_ip = LicensesUse::where('license_id', $license->id)->where('ip', '!=', $ip)->count();
            if ($license->use_limit != null && $license->parallel_use_limit != null) {
                if ($check_count_ip >= $license->parallel_use_limit) {
                    $status = false;
                    $errors[] = trans('lang.exceeding_the_limit_of_devices');
                }
            }
        }

        if ($license->ip and $license->type == 1) {
            $ip_array = explode(',', $license->ip);
            if (!in_array($ip, $ip_array)) {
                $status = false;
                $errors[] = trans('lang.ip_address_is_not_allowed_to_login');

                // $setting = Setting::first();
                // $api_blocked = explode(',',$setting->api_blacklisted_ips);
                // $api_blocked[] = $ip;
                // $setting->api_blacklisted_ips = implode(',',$api_blocked);
                // $setting->save();
            }
        }

        if ($status == true) {
            $status_data  = 1;
        } else {
            $status_data = 0;
        }
        // if($license->type == 1){
        //     $check_count_used_ip = LicensesUse::where('license_id',$license->id)->where('ip','!=',$ip)->where('is_used',1)->count();
        //     if($check_count_used_ip >= $license->use_limit){
        //         $status = false;
        //         $errors[] = trans('lang.exceeded_usage_limit');
        //     }
        // }

        if ($status == false) {
            $errors = implode(",", $errors);
            $apiData = MyModel::create(['product_id' => $p_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'validation_error' => $errors, 'function' => MyModel::SignIn]);

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
        }

        $errors = implode(",", $errors);
        $licenses_ip = LicensesUse::where('license_id', $license->id)->where('ip', $ip)->first();
        if (!$licenses_ip) {
            $licenses_ip = new LicensesUse();
            $licenses_ip->ip = $ip;
            $licenses_ip->license_id = $license->id;
        }
        $licenses_ip->is_used = 1;
        $licenses_ip->mac_address = $unhash['macaddress'];
        $licenses_ip->uuid = $unhash['uuid'];
        $licenses_ip->save();
        $client->update([
            'last_seen_at' => Carbon::now(),
        ]);
        $apiData = MyModel::create(['product_id' => $p_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'validation_error' => $errors, 'function' => MyModel::SignIn]);
        return response()->json(['status' => true, 'data' => $licenses_ip, 'msg' => trans('lang.success'), 'errors' => ''], 200);
    }
}
