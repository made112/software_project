<?php

namespace App\Listeners;

use App\Events\AddNewVersionEvent;
use App\Notifications\AddNewManagerToCompanyNotification;
use App\Notifications\AddNewVersionToProductNotification;
use App\Notifications\UpdateProductNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNewVersionListener
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
    public function handle(AddNewVersionEvent $event)
    {
        $product = $event->product;

        $user = $product->user;

        $product->user->notify(new AddNewVersionToProductNotification($user, $product));
    }
}
