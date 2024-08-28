<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpclarkson\Laravel\Freshdesk\Facades\Freshdesk;

class FreshDeskController extends Controller
{
    public function tickets()
    {
        $ticket = Freshdesk::tickets()->all();

        return $ticket;
    }

    public function replyTickets(Request $request, $id)
    {
        $ticket = Freshdesk::tickets()->view($id);

        if($request->users) {
            $count = count($request->users); // 5


            for($i = 0; $i < $count; $i++ ) {
                $conversation = Freshdesk::conversations()->reply($ticket['id'], [
                    'body' => 'Please take a look at ticket # '.$ticket['id'] .' By '. $request->users[$i],
                    'from_email' => $request->from_email,
                ]);
            }

            return response()->json([
                'conversation' => $conversation,
                'ticket' => $ticket,
            ]);
        }

        $conversation = Freshdesk::conversations()->reply($ticket['id'], [
            'body' => $request->msg,
            'from_email' => $request->from_email,
        ]);


        return response()->json([
            'conversation' => $conversation,
            'ticket' => $ticket,
        ]);
    }

    public function deleteConversation($id)
    {
        $tickets = Freshdesk::conversations()->delete($id);

        return redirect()->back();
    }

    public function updateTicket(Request $request, $id)
    {
        $ticket = Freshdesk::tickets()->update($id ,[
            'status' => (int)$request->status,
            'type' => $request->type,
            'priority' => (int)$request->priority,
            'group_id' => (int)$request->group_id,
        ]);

        return redirect()->back();
    }

    public function deleteTicket($id)
    {
        $tickets = Freshdesk::tickets()->delete($id);

        return redirect()->route('admin.tickets.index');
    }

    public function getAgent($id)
    {
        $ticket = Freshdesk::groups()->view($id);
        $users = array();
        foreach($ticket['agent_ids'] as $agent){
            $users[] = Freshdesk::agents()->view($agent);
        };

        return response()->json([
            'data' => $users,
        ]);

    }
}
