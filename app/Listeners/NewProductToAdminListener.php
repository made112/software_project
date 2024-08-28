<?php

namespace App\Listeners;

use App\Events\NewProductToAdminEvent;
use App\Notifications\NewProductToAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewProductToAdminListener
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
    public function handle(NewProductToAdminEvent $event)
    {
        $admin = $event->admin;

        $product = $event->product;

        $admin->notify( new NewProductToAdminNotification($admin, $product) );
    }
}
