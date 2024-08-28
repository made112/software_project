<?php

namespace App\Http\Controllers\Admin;

use App\Events\ForwardTicketEvent;
use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function store(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'description' => ['required'],
        ]);

        if($request->users) {
            $user = User::query()->where('id', $request->users)->first();

            Reply::create([
                'description' => $user->name . ' ' . $request->description,
                'from_email' => $request->from_email,
                'to_email' => $user->email,
                'ticket_id' => $id,
                'ip' => request()->ip(),
            ]);

            $ticket = Ticket::where('id', $id)->first();

            event(new ForwardTicketEvent($ticket, $user));

        }else{
            Reply::create([
                'description' => $request->description,
                'from_email' => $request->from_email,
                'to_email' => $request->to_email,
                'ticket_id' => $id,
                'ip' => request()->ip(),
            ]);
        };

        $ticket = Ticket::where('id', $id)->first();

        $ticket->update([
            'condition' => 2,
        ]);

        $last_reply = Reply::query()->orderBy('created_at', 'desc')->first();

        return redirect()->back();
//        return response()->json([
//           'reply' => $last_reply,
//        ]);
    }
}
