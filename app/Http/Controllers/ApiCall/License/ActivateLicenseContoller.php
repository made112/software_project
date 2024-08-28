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
use App\Models\LicensesUse;
use App\Notifications\ActivationModelNotification;
use App\Models\Versions;
use App\Models\ClientsProducts;
use App\Services\License\HashService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Spatie\Crypto\Rsa\Exceptions\CouldNotDecryptData;
use Spatie\Crypto\Rsa\KeyPair;
use Spatie\Crypto\Rsa\PrivateKey;
use Spatie\Crypto\Rsa\PublicKey;

class ActivateLicenseContoller  extends Controller
{

    protected $model;
    protected $hashService;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
        $this->hashService = new HashService();
    }

    public function ActivateLicense(Request $request)
    {
        DB::beginTransaction();
        try {
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
                'port' => ['required'],
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
                $check_count_ip = LicensesUse::where('license_id', $license->id)->where('ip', '!=', $ip)->where('port',  '!=', $unhash['port'])->count();
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
            $licenses_ip = LicensesUse::where('license_id', $license->id)
            ->where('uuid', $unhash['uuid'])
            ->where('ip', $ip)
            ->where('port', $unhash['port'])->first();
            // return [$licenses_ip];


            if (!$licenses_ip) {
                $licenses_ip =  LicensesUse::create([
                    'ip' => $ip,
                    'port' => $unhash['port'],
                    'license_id' => $license->id,
                    'mac_address' => $unhash['macaddress'],
                    'uuid' => $unhash['uuid'],
                ]);

            }



            $licenses_ip->is_used = 1;
            $licenses_ip->save();


            DB::commit();

            DB::beginTransaction();


            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);
            $apiData = MyModel::create(['product_id' => $p_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'validation_error' => $errors, 'function' => MyModel::SignIn]);
            // return response()->json(['status' => true, 'data' => $licenses_ip, 'msg' => trans('lang.success'), 'errors' => ''], 200);

            if ($request->has('encrypted_data') && $request->has('public_key')) {
                // return $request->all();
                $data = $this->hashService->SSLDecrypt($request->input('encrypted_data'), $request->input('public_key'));
                $data['public_key'] = $request->input('public_key');

                $validator = Validator::make($data, [
                    'public_key' => ['required'],
                    'uuid' => ['required'],
                    'client_id' => ['required'],
                    'macaddress' => ['nullable'],
                    'os_type' => ['nullable'],
                ]);

                if ($validator->fails()) {
                    $errors[] = __('lang.invalid_data_attribute');
                    return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
                }
            } else {
                $errors[] = __('lang.invalid_data_attribute');
                return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
            }
            $client_id = $request->header('client-id');
            $license_code = $request->header('license-code');
            $api_key = $request->header('api-key');
            $domain = \Request::root();
            $ip = \Request::ip();
            $product_id = null;
            $status = true;
            $errors = array();
            $cl_id = null;
            $client = Clients::where('client_id', $client_id)->first();
            $cl_id = $client->id;

            $license = License::where('license_code', $license_code)->where('client_id', $cl_id)->first();
            if (!$license) {
                $status = false;
                $errors[] = trans('lang.license_code_not_found');
            } else {
                if ($license->block == 1) {
                    $status = false;
                    $errors[] = trans('lang.license_is_blocked');
                }

                $product_id = $license->product_id;
                $product = Products::find($product_id);
                if ($product) {
                    if ($license->date and $license->date < date('Y-m-d') and $product->download_update == 1) {
                        $status = false;
                        $errors[] = trans('lang.license_is_expired');
                    }
                } else {
                    $status = false;
                    $errors[] = trans('lang.product_not_found') . ' ID:' . $product_id;
                    $product_id = null;
                }
            }

            //                    if ($license) {
            //                        if($license->type == 1){
            //                            $check_count_used_ip = LicensesUse::where('license_id',$license->id)->where('ip','!=',$ip)->where('is_activate',1)->count();
            //                            if($check_count_used_ip >= $license->use_limit && $license->use_limit != null && $license->parallel_use_limit != null){
            //
            //                    }
            //            $check_count_used_ip = LicensesUse::where('license_id', $license->id)
            //                ->where('ip', '!=', $ip)->where('is_activate', 1)->count();
            //
            //            dd($license->use_limit , $license->parallel_use_limit);
            //
            //            dd( $check_count_used_ip >= $license->use_limit, $license->use_limit != null, $license->parallel_use_limit != null  );

            if ($license) {
                if ($license->type == 1) {
                    $check_count_used_ip = LicensesUse::where('license_id', $license->id)
                        ->where('ip', '!=', $ip)->where('ip', '!=', $ip)->where('port',  '!=', $unhash['port'])->where('is_activate', 1)->count();
                    if ($check_count_used_ip != 0 && $check_count_used_ip >= $license->use_limit) {
                        $status = false;
                        $errors[] = trans('lang.exceeded_usage_limit');
                    }
                }
            }

            // return [$licenses_ip , $unhash , $license];

            // $licenses_ip = LicensesUse::where('license_id', $license->id)->where('ip', $ip)->where('port', $unhash['port'])->first();
            // return [$licenses_ip , $unhash , $license];
            if (!$licenses_ip) {
                $status = false;
                $errors[] = trans('lang.ip_not_signed_in');
            } else {
                $licenses_ip->update($data);

                if ($licenses_ip->is_used == 0 and $license->type == 1) {
                    $status = false;
                    $errors[] = trans('lang.ip_not_signed_in');
                }

                if ($licenses_ip->is_activate == License::ACTIVATE) {
                    $status = true;
                    $errors[] = trans('lang.license_already_activated');
                    $unhash = [
                        "product_id" => $product->product_id,
                        "client_id" => $client_id,
                        "date" => $license->date,
                        "license_code" => $license->license_code,
                        "days" => $license->days,
                        "end_days" => "0",
                        "startDate" => date('Y-m-d'),
                        "last_check_date" => now(),
                        "endDate" => $license->date,
                        "ip" => $licenses_ip->ip,
                        "uuid" => $licenses_ip->uuid,
                        "macaddress" => $licenses_ip->mac_address
                    ];
                    $encryptedLicense = $this->hashService->SSLEncrypt(json_encode($unhash));
                    return response()->json(['status' => true, 'data' => $encryptedLicense, 'msg' => trans('lang.license_already_activated')], 200);
                }
            }


            if ($status == true) {
                $status_data  = 1;
            } else {
                $status_data = 0;
            }
            $errors = implode(",", $errors);

            if ($status == false) {
                $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'function' => MyModel::ActivateLicense]);
                return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
            }


            $licenses_ip->is_activate = 1;
            $licenses_ip->save();

            $license->update(['usage' => License::ACTIVATE, 'public_key' => $data['public_key']]);

            $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'function' => MyModel::ActivateLicense]);
            // return [$product->product_id];
            Notification::route('mail', $client->email)->notify(new ActivationModelNotification([
                'title' => __('mail.activate_license_title'),
                'content' => __('mail.activate_license_content', ['license_name' => $license->name]),
                'license_code' =>  __('mail.license_code') . ': ' . $license->license_code,
                'product' =>  __('mail.product') . ': ' . $license->product->name,
                'ip' => 'IP: ' . $ip,
                'flag' => 1
            ]));

            $unhash = [
                "product_id" => $product->product_id,
                "client_id" => $client_id,
                "date" => $license->date,
                "license_code" => $license->license_code,
                "days" => $license->days,
                "end_days" => "0",
                "startDate" => date('Y-m-d'),
                "last_check_date" => now(),
                "endDate" => $license->date,
                "ip" => $licenses_ip->ip,
                "uuid" => $licenses_ip->uuid,
                "macaddress" => $licenses_ip->mac_address
            ];


            $encryptedLicense = $this->hashService->SSLEncrypt(json_encode($unhash));
            // $encryptedLicense = $this->hashService->encryption(['license' => $encryptedLicense], 2);
            // return dd($encryptedLicense);
            // return response()->json(['status' => true, 'data' => $encryptedLicense, '1' => $unhash, 'msg' => trans('lang.success'), 'errors' => ''], 200);

            DB::commit();

            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);



            return response()->json(['status' => true, 'data' => $encryptedLicense, 'msg' => trans('lang.success'), 'errors' => ''], 200);
        } catch (\Exception $e) {
            DB::rollback();

            //dd( ['product_id' => $product_id, 'client_id' => $cl_id, 'status' => 0, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'errors' => $e, 'function' => MyModel::ActivateLicense] );

            $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => 0, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'errors' => $e, 'function' => MyModel::ActivateLicense]);
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors . ',' . $e], 422);
        }
    }


    public function ActivateOfflineLicense(Request $request)
    {
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');
        $uuid = $request->get('uuid');
        $macaddress = $request->get('macaddress');
        $domain = \Request::root();
        $ip = \Request::ip();
        $product_id = null;
        $status = true;
        $errors = array();
        $cl_id = null;
        $client = Clients::where('client_id', $client_id)->first();
        $cl_id = $client->id;

        if (!$macaddress) {
            $status = false;
            $errors[] = trans('lang.macaddress_required');
        }

        if (!$uuid) {
            $status = false;
            $errors[] = trans('lang.uuid_required');
        }

        if ($status == true) {
            $license = License::where('uuid', $uuid)->where('client_id', $cl_id)->first();
            if (!$license) {
                $status = false;
                $errors[] = trans('lang.license_code_not_found');
            } else {

                if ($macaddress != $license->machine_id) {
                    //>>>>>>> development
                    $status = false;
                    $errors[] = trans('lang.macaddrees_wrong');
                }

                if ($ip != $license->ip) {
                    $status = false;
                    $errors[] = trans('lang.ip_wrong');
                }

                if ($license->block == 1) {
                    $status = false;
                    $errors[] = trans('lang.license_is_blocked');
                }

                $product_id = $license->product_id;
                $product = Products::find($product_id);
                if ($product) {
                    if ($license->date and $license->date < date('Y-m-d') and $product->download_update == 1) {
                        $status = false;
                        $errors[] = trans('lang.license_is_expired');
                    }
                } else {
                    $status = false;
                    $errors[] = trans('lang.product_not_found') . ' ID:' . $product_id;
                    $product_id = null;
                }
                //<<<<<<< HEAD

            }


            $licenses_ip = LicensesUse::where('license_id', $license->id)->where('ip', $ip)->where('port', $unhash['port'])->first();
            if (!$licenses_ip) {

                $status = false;
                $errors[] = trans('lang.ip_not_signed_in');
            } else {
                if ($licenses_ip->is_activate == License::ACTIVATE) {
                    $status = false;
                    $errors[] = trans('lang.license_already_activated');
                }
            }
        }



        if ($status == true) {
            $status_data  = 1;
        } else {
            $status_data = 0;
        }
        $errors = implode(",", $errors);

        if ($status == false) {
            $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'function' => MyModel::ActivateLicense]);
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
        }

        DB::beginTransaction();
        try {

            $licenses_ip->is_activate = 1;
            $licenses_ip->save();

            $license->update(['usage' => License::ACTIVATE]);
            $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'function' => MyModel::ActivateLicense]);
            \Notification::route('mail', $client->email)->notify(new ActivationModelNotification([
                'title' => __('mail.activate_license_title'),
                'content' => __('mail.activate_license_content', ['license_name' => $license->name]),
                'license_code' =>  __('mail.license_code') . ': ' . $license->license_code,
                'product' =>  __('mail.product') . ': ' . $license->product->name,
                'ip' => 'IP: ' . $ip,
                'flag' => 1
            ]));

            DB::commit();

            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);
            return response()->json(['status' => true, 'data' => $license, 'msg' => trans('lang.success'), 'errors' => ''], 200);
        } catch (\Exception $e) {
            DB::rollback();
            $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => 0, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'errors' => $e, 'function' => MyModel::ActivateLicense]);

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors . ',' . $e], 422);
        }
    }
}
