<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketSystemRequest;
use App\Http\Resources\TicketResourses\PriorityResourse;
use App\Http\Resources\TicketResourses\StatusResourse;
use App\Http\Resources\TicketResourses\TagResourse;
use App\Http\Resources\TicketResourses\TypeResourse;
use App\Models\ApiCall;
use App\Models\Clients;
use App\Models\Group;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function Symfony\Component\Translation\t;

class TicketsSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
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

        $client = Clients::query()->where('client_id', $client_id)->first();
        $group = Group::query()->where('id', $group_id)->first();

//        Ticket::
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

        Ticket::create([
            'title' => $title,
            'description' => $description,
            'email' => $client->email,
            'priority' => $priority,
            'status' => $status_body,
            'type' => $type,
            'condition' => 1,
            'ip' => $ip,
            'client_id' => $client->id,
            'group_id' => $group->id,
        ]);

        ApiCall::create([
            'client_id' => $client->id,
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
            'data' => Ticket::orderBy('id', 'desc')->first(),
            'msg' => 'Successfully Created Ticket',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request)
    {
        // From Headers
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');
        $ticket_id = $request->header('ticket-id');


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

        $client = Clients::query()->where('client_id', $client_id)->first();
        $group = Group::query()->where('id', $group_id)->first();

//        Ticket::
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

        $ticket = Ticket::where('client_id',  $client->id)->get();

        if ( !$ticket ) {
            return response()->json([
                'status' => false,
                'data' =>  null,
                'msg' => 'Ticket Not Found',
            ]);
        }

        if ( $client ) {
            foreach ( $ticket as $ti ) {
                if ( $ti->client_id != $client->id ) {
                    return response()->json([
                        'status' => false,
                        'data' =>  null,
                        'msg' => 'This Ticket Not Assign To The Client',
                    ]);
                }
            }
        }

        ApiCall::create([
            'client_id' => $client->id,
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
            'data' => $ticket,
            'msg' => 'Success',
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
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

        $client = Clients::query()->where('client_id', $client_id)->first();
        $group = Group::query()->where('id', $group_id)->first();

//        Ticket::
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

        $ticket = Ticket::query()->where('id', $id)->first();




        if ( $ticket ) {

            if ( $client ) {
                if ( $ticket->client_id != $client->id ) {
                    return response()->json([
                        'status' => false,
                        'data' =>  null,
                        'msg' => 'This Ticket Not Assign To The Client',
                    ]);
                }
            }

            if ( $ticket->status == 4 ) {
                return response()->json([
                    'status' => false,
                    'data' => null,
                    'msg' => 'Already Closed',
                ]);
            }



            $ticket->update([
                'status' => 4,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'No Ticket Found',
            ]);
        }




        ApiCall::create([
            'client_id' => $client->id,
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
            'data' => $ticket,
            'msg' => 'Successfully Closed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
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

        $client = Clients::query()->where('client_id', $client_id)->first();
        $group = Group::query()->where('id', $group_id)->first();

//        Ticket::
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

        $ticket = Ticket::query()->where('id', $id)->first();

        if ( $ticket ) {

            if ( $client ) {
                if ( $ticket->client_id != $client->id ) {
                    return response()->json([
                        'status' => false,
                        'data' =>  null,
                        'msg' => 'This Ticket Not Assign To The Client',
                    ]);
                }
            }


            $replies = Reply::where('ticket_id', $ticket->id)->get();

            foreach ( $replies as $reply ) {
                $reply->delete();
            }

            $ticket->delete();
        } else {
            return response()->json([
            'status' => false,
            'msg' => 'This Ticket Already Deleted',
            ]);
        }

        ApiCall::create([
            'client_id' => $client->id,
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
            'msg' => 'Successfully Deleted',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Request $request, $id)
    {
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

        $client = Clients::query()->where('client_id', $client_id)->first();
        $group = Group::query()->where('id', $group_id)->first();

//        Ticket::
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

        $ticket = Ticket::query()->where('id', $id)->first();

        if ( $ticket ) {

            if ( $client ) {
                if ( $ticket->client_id != $client->id ) {
                    return response()->json([
                        'status' => false,
                        'data' =>  null,
                        'msg' => 'This Ticket Not Assign To The Client',
                    ]);
                }
            }

            if ( $ticket->status == 1 ) {
                return response()->json([
                    'status' => false,
                    'msg' => 'This Ticket Already Opened',
                ]);
            }

            $ticket->update([
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'No Ticket Found',
            ]);
        }

        ApiCall::create([
            'client_id' => $client->id,
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
            'data' => $ticket,
            'msg' => 'Successfully Restored',
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function ticketSetting(){
        $tag = Tag::get();
        $type = TicketType::get();
        $priory = TicketPriority::get();
        $status = TicketStatus::get();
        $resourses = [
            'tags'=>TagResourse::collection($tag),
            'type'=>TypeResourse::collection($type),
            'priory'=>PriorityResourse::collection($priory),
            'status'=>PriorityResourse::collection($status),
        ];
        return response()->json([
            'status'=>true,
            'msg'=>'success',
            'data'=>$resourses
        ]);
    }
}
