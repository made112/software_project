<?php

namespace App\Listeners;

use App\Events\ForwardTicketEvent;
use App\Notifications\ForwardTicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ForwardTicketListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ForwardTicketEvent $event)
    {
        $user = $event->user;
        $ticket = $event->ticket;

        $user->notify(new ForwardTicketNotification($ticket, $user));
    }
}
