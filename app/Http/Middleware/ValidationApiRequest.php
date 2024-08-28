<?php

namespace App\Http\Middleware;

use App\Models\ApiCall;
use App\Models\ApiKey;
use App\Models\Clients;
use App\Models\License;
use App\Models\Versions;
use App\Models\Setting;
use App\Models\Products;
use Closure;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class ValidationApiRequest extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Http\Exceptions\PostTooLargeException
     */
    public function handle($request, Closure $next)
    {
        \App::setlocale('en');
        $errors = array();
        $status = true;
        $client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $version_id = $request->get('version_id');
        $product_id = $request->get('product_id');
        $download_url = $request->get('download_url');
        $domain = \Request::root();
        $ip = \Request::ip();
        $setting = Setting::first();
        $api_request_rate_limiting_methond = $setting->api_request_rate_limiting_methond;
        $api_request_rate_limit = $setting->api_request_rate_limit;
        // var_dump($domain);exit;
        $function_name = explode('@',\Route::getCurrentRoute()->getActionName())[1];
        if($function_name == 'GetLastVersion'){
            $function_name = ApiCall::GetLastVersion;
        }else if ($function_name == 'CheckAvailabilityLicense'){
            $function_name = ApiCall::CheckAvailabilityLicense;
        }else if($function_name == 'ActivateLicense'){
            $function_name = ApiCall::ActivateLicense;
        }else if($function_name == 'DeactivateLicense'){
            $function_name = ApiCall::DeactivateLicense;
        }else if($function_name == 'CheckUpdate'){
            $function_name = ApiCall::CheckUpdate;
        }else if($function_name == 'UpdateDownload'){
            $function_name = ApiCall::UpdateDownloads;
        }else if($function_name == 'ViewPackage'){
            $function_name = ApiCall::ViewPackage;
        }else if($function_name == 'signIn'){
            $function_name = ApiCall::SignIn;
        }else if($function_name == 'signOut'){
            $function_name = ApiCall::SignOut;
        }
        $p_id=null;$v_id=null;$cl_id=null;

        $check_special_permission = 0;

        $api_key_data = ApiKey::where('api_key', $api_key)->first();
        if (!$api_key_data) {
            $status = false;
            $errors[] = trans('lang.api_key_not_found');
        }else{
            $check_special_permission = $api_key_data->special_permission;
        }

        if($check_special_permission == 0){
            $check_api_rate = ApiCall::whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d %H") = DATE_FORMAT("'.date('Y-m-d H').'","%Y-%m-%d %H")');
            if ($api_request_rate_limiting_methond == 1) {
                $check_api_rate = $check_api_rate->where('ip', $ip);
            } else {
                $check_api_rate = $check_api_rate->where('domain', $domain);
            }
            $check_api_rate = $check_api_rate->where('status',1)->groupByRaw('DATE_FORMAT(created_at,"%Y-%m-%d %H")')->count();

            if ($check_api_rate >= $api_request_rate_limit and $api_request_rate_limit != 0) {
                $status = false;
                $errors[] = trans('lang.exceeded_api_request_rate_limit');
            }
        }

        if ($client_id == '' or ($license_code == '' and $function_name != 7) or $api_key == '') {
            $status = false;
            if ($client_id == '') {
                $errors[] = trans('lang.client_required');
            }

            if ($license_code == '') {
                $errors[] = trans('lang.license_code_required');
            }
            if ($api_key == '') {
                $errors[] = trans('lang.api_key_required');
            }
        }

        if($client_id){
            $client = Clients::where('client_id',$client_id)->first();
            if (!$client) {
                $status = false;
                $errors[] = trans('lang.client_not_found').' ID:'.$client_id;
                $client_id = null;
            }else{
                $cl_id = $client->id;
            }
        }

        if($version_id){
            $version = Versions::where('id',$version_id)->first();
            if(!$version){
                $status = false;
                $errors[] = trans('lang.version_not_found').' ID:'.$version_id;
                $version_id = null;
            }else{
                $v_id = $version->id;
            }
        }

        if($product_id){
            $product = Products::where('product_id',$product_id)->first();
            if(!$product){
                $status = false;
                $errors[] = trans('lang.product_not_found').' ID:'.$product_id;
                $product_id = null;
            }else{
                $p_id = $product->id;
            }
        }


        if ($status == false) {
            $errors = implode(",", $errors);
            $apiData = ApiCall::create(['version_id'=>$v_id,'download_url'=>$download_url,'function'=>$function_name,'product_id'=>$p_id,'client_id'=>$cl_id,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>$function_name]);
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
        }



        if($function_name != 7){
            $license = License::where('license_code', $license_code)->first();
            if (!$license) {
                $status = false;
                $errors[] = trans('lang.license_code_not_found');
            }else{
                if($license->client_id != $cl_id){
                    $status = false;
                    $errors[] = trans('lang.license_code_does_not_belong_to_client');
                }

                if($license->block == 1){
                    $status = false;
                    $errors[] = trans('lang.license_is_blocked');
                }
            }
        }

        if($check_special_permission == 0){
            $check_ip = Setting::whereRaw('FIND_IN_SET("' . $ip . '",`api_blacklisted_ips`)')->first();
            if ($check_ip) {
                $status = false;
                $errors[] = trans('lang.ip_blocked');
            }

            $check_domain = Setting::whereRaw('FIND_IN_SET("' . $domain . '",`api_blacklisted_domain`)')->first();
            if ($check_domain) {
                $status = false;
                $errors[] = trans('lang.domain_blocked');
            }
        }


        if ($status == true) {
            return $next($request);
        } else {
            $errors = implode(",", $errors);
            $apiData = ApiCall::create(['product_id'=>$p_id,'download_url'=>$download_url,'version_id'=>$v_id,'client_id'=>$cl_id,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>$function_name]);
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
        }
    }
}
