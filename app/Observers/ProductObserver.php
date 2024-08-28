<?php

namespace App\Observers;

use App\Jobs\SendEmailToClientsWithNewProduct;
use App\Models\Clients;
use App\Models\Products;
use App\Models\User;
use App\Notifications\BlockModelNotification;
use App\Notifications\NewProductNotification;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    /**
     * send email when create new product
     *
     * @param Products $products
     */
    public function created(Products $products)
    {
        SendEmailToClientsWithNewProduct::dispatch($products);
    }


    /**
     * send block email to when deactivate product
     *
     * @param Products $products
     */
    public function updated(Products $products)
    {
        if ($products->isDirty('status')) {
            if ($products->status == 2) {
                try {
                    Notification::send($products->clients, new BlockModelNotification([
                        'title' => __('mail.block_product_title'),
                        'content' => __('mail.block_product_content', ['product_name' => $products->name])
                    ]));
                } catch (\Throwable $th) {
                    activity()->causedBy(new User())->log('cannot send email to clients : ' . implode(' , ', $products->clients->pluck('name')->toArray()) . 'when deactivate product');
                }
            }
        }
    }
}
