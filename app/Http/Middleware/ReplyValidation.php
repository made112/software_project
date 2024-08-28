<?php

namespace App\Http\Middleware;

use App\Models\ApiCall;
use App\Models\ApiKey;
use App\Models\Clients;
use App\Models\Ticket;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ReplyValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $errors = array();
        $status = true;

        // From Headers
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');
        $ticket_id = $request->header('ticket-id');

        // From Body
        $description = $request->get('description');
        $from_email = $request->get('from_email');
        $to_email = $request->get('to_email');

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
        $tk_id = null;




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
                $errors[] = 'Api Key Not Found';
            }
        }elseif ( !$api_key ) {
            $status = false;
            $errors[] = 'Api Key Required';
        }
        // End Validation For Api key

        // Start Description Validation
        if ( $request->isMethod('post') ) {

            // Start Ticket ID Validation
            if( $ticket_id ){
                $ticket = Ticket::query()->where('id', $ticket_id)->first();

                if ( !$ticket ){
                    $status = false;
                    $errors[] = 'Ticket ID Not Found';
                }else{
                    $tk_id = $ticket->id;
                }
            }else{
                $status = false;
                $errors[] = 'Ticket ID Required';
            }
            // End Ticket ID Validation

            if ( !$description ) {
                $status = false;
                $errors[] = 'Description Required';
            }
            // End Description Validation

            // Start From Email Validation
            if ( !$from_email ) {
                $status = false;
                $errors[] = 'From Email Required';
            }
            // End From Email Validation

            // Start To Email Validation
            if ( !$to_email ) {
                $status = false;
                $errors[] = 'To Email Required';
            }
            // End To Email Validation
        }

        if ( $status == true ) {
            return $next($request);
        }else{
            $errors = implode(",", $errors);
            $apiData = ApiCall::create([
                'client_id' => $cl_id,
                'api_key' => $api_key,
                'ip' => $ip,
                'domain' => $domain,
                'validation_error' => $errors,
                'function' => $function_name,
            ]);

            if ( $client ) {
                $client->update([
                    'last_seen_at' => Carbon::now(),
                ]);
            }

            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
        }
    }
}
