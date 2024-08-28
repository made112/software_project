<?php

namespace App\Jobs;

use App\Models\Clients;
use App\Models\Versions;
use App\Notifications\NewProductVersionNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendEmailToClientsWhenCreateProductVersion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    // public $version;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->version = $version;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $versions = Versions::where('date', date('Y-m-d'))->get();

        foreach ($versions as $version) {
            if ($version->product->download_update) {
                $licensIds = $version->product->licenses()->where('block', false)->pluck('id')->toArray();
                $clients = Clients::whereHas('licenses', function ($query) use ($licensIds) {
                    return $query->whereIn('id', $licensIds);
                });
            } else {
                $clients = Clients::query();
            }

            $clients->chunk(100, function ($users) use ($version) {
                Notification::send($users, new NewProductVersionNotification($version));
            });
        }
    }
}
