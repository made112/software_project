<?php

namespace App\Http\Middleware;

use App\Models\ApiCall;
use App\Models\ApiKey;
use App\Models\Clients;
use App\Models\Group;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TicketSystemValidation extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $errors = array();
        $status = true;

        // From Headers
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');


        // From Body
        $group_id = $request->get('group_id');
        $title = $request->get('title');
        $description = $request->get('description');
        $priority = $request->get('priority');
        $status_body = $request->get('status');
        $type = $request->get('type');

        // IP & Domain
        $domain = \Request::root();
        $ip = \Request::ip();

        // Function Name
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
        }else if($function_name == 'CreateTicket'){
            $function_name = ApiCall::CreateTicket;
        }

        $cl_id = null;
        $gr_id = null;
        // Start Validation For Client_id
        $client = null;
        if( $client_id ) {
            $client = Clients::query()->where('client_id', $client_id)->first();

            if ( !$client ) {
                $status = false;
                $errors[] = 'Client ID Not Found';
            }else{
                $cl_id = $client->id;
            }
        }elseif( !$client_id ) {
            $status = false;
            $errors[] = 'Client ID Required';
        }
        // End Validation For Client_id

        // Start Validation For Api key
        if ( $api_key ) {
            $api_key_data = ApiKey::query()->where('api_key', $api_key)->first();

            if( !$api_key_data ){
                $status = false;
                $errors[] =  'Api Key Not Found';
            }
        }elseif ( !$api_key ) {
            $status = false;
            $errors[] = 'Api Key Required';
        }
        // End Validation For Api key


        if ( $request->isMethod('post') ) {
            // Start Validation For Group_id
            if( $group_id ) {
                $group = Group::where('id', $group_id)->first();

                if( !$group ){
                    $status = false;
                    $errors[] = 'Group ID Not Found';
                }else{
                    $gr_id = $group->id;
                }
            }elseif ( !$group_id ){
                $status = false;
                $errors[] = 'Group ID Required';
            }
            // End Validation For Group_id

            // Start Title Validation
            if (!$title) {
                $status = false;
                $errors[] = 'Title Required';
            }
            // End Title Validation

            // Start Description
            if (!$description) {
                $status = false;
                $errors[] = 'Description Required';
            }
            // End Description

            // Start Priority
            if ( !$priority ) {
                $status = false;
                $errors[] = 'Priority Required';
            }
            // End Priority

            // Start Status Body
            if ( !$status_body ) {
                $status = false;
                $errors[] = 'Status Required';
            }
            // End Status Body

            // Start Type
            if ( !$type ) {
                $status = false;
                $errors[] = 'Type Required';
            }
            // End Type
        }



        if ( $status == true ) {
            return $next($request);
        }else{

            if ( $client ) {
                $client->update([
                    'last_seen_at' => Carbon::now(),
                ]);
            }

            $errors = implode(",", $errors);
            $apiData = ApiCall::create([
                'client_id' => $cl_id,
                'api_key' => $api_key,
                'ip' => $ip,
                'domain' => $domain,
                'validation_error' => $errors,
                'function' => $function_name,
            ]);
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
        }
    }
}
