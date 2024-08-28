<?php

namespace App\Jobs;

use App\Models\Clients;
use App\Models\License;
use App\Notifications\LicenseReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FirstThirdTimeLicenseDateReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        License::with('client')
            ->select(\DB::raw('* , (DateDiff(created_at,CURDATE())*100.0)/DateDiff(created_at,date) as precentage'))
            ->havingRaw('precentage between 32 and 34')->chunk(100, function ($licenses) {
                foreach ($licenses as $license) {
                    $license->client->notify(new LicenseReminderNotification($license));
                }
            });
    }
}
