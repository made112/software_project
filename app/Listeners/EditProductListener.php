<?php

namespace App\Listeners;

use App\Events\EditProductEvent;
use App\Models\Products;
use App\Models\User;
use App\Notifications\UpdateProductNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EditProductListener
{

    /**
     * @var \App\Models\Products
     */
    public $product;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Products $product)
    {
        $this->product = $product;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EditProductEvent $event)
    {
        $product = $event->product;

        $user = $product->user;

        $product->user->notify(new UpdateProductNotification($user, $product));
    }
}
