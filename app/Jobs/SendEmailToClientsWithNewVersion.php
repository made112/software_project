<?php

namespace App\Jobs;

use App\Models\Clients;
use App\Models\Products;
use App\Models\License;
use App\Models\ClientsProducts;
use App\Notifications\NewProductVersionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToClientsWithNewVersion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $version;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($version)
    {
        $this->version = $version;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = Products::find($this->version->product_id);
        $clients_products = License::where('product_id',$this->version->product_id);
        if($product->download_update == 1){
            $clients_products = $clients_products->where(function($q) {
                                    $q->where('date','>=',date('Y-m-d'))->orWhereNull('date');
                                });
        }
        $clients_products = $clients_products->where('block',0)->pluck('client_id')->ToArray();
       
        $clients = Clients::whereIn('id',$clients_products);
        $clients->chunk(100, function ($users) {
            foreach ($users as $user) {
                $user->notify(new NewProductVersionNotification($this->version));
            }
        });
    }
}
