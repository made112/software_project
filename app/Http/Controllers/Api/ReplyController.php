<?php

namespace App\Http\Controllers\Api;

use App\Events\ForwardTicketEvent;
use App\Http\Controllers\Controller;
use App\Models\ApiCall;
use App\Models\Clients;
use App\Models\Reply;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $errors = array();
        $status = true;

        // From Headers
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');
        $ticket_id = $request->header('ticket-id');

        $client = Clients::query()->where('client_id', $client_id)->first();

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

        Reply::create([
            'ticket_id' => $ticket_id,
            'description' => $description,
            'from_email' => $from_email,
            'to_email' => $to_email,
            'ip' => $ip,
        ]);

        $ticket = Ticket::where('id', $ticket_id)->first();

        $ticket->update([
            'condition' => 2
        ]);

        ApiCall::create([
            'api_key' => $api_key,
            'ip' => $ip,
            'domain' => $domain,
            'function' => $function_name,
            'status' => 1,
        ]);

        $client->update([
            'last_seen_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => true,
            'data' => Reply::orderBy('id', 'desc')->with('ticket')->first(),
            'msg' => 'Successfully Replied',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showAll(Request $request, $id)
    {
        $errors = array();
        $status = true;

        // From Headers
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');
        //$ticket_id = $request->header('ticket-id');
//
        $client = Clients::query()->where('client_id', $client_id)->first();

//        // From Body
//        $description = $request->get('description');
//        $from_email = $request->get('from_email');
//        $to_email = $request->get('to_email');

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

        $ticket = Ticket::where('id', $id)->first();

        if ( !$ticket ) {
            return response()->json([
                'status' => false,
                'data' =>  null,
                'msg' => 'Ticket Not Found',
            ]);
        }

        $replies = Reply::query()->where('ticket_id', $id)->get();

        if ( $client ) {
            if ( $ticket->client_id != $client->id ) {
                return response()->json([
                    'status' => false,
                    'data' =>  null,
                    'msg' => 'This Ticket Not Assign To The Client',
                ]);
            }
        }


        if ( $replies ) {
            ApiCall::create([
                'api_key' => $api_key,
                'ip' => $ip,
                'domain' => $domain,
                'function' => $function_name,
                'status' => 1,
            ]);

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => true,
                'data' =>  $replies,
                'msg' => 'Successfully Replied',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => 'No Ticket',
                'msg' => 'Success',
            ]);
        }

    }
}
