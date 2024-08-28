<?php

namespace App\Jobs;

use App\Listeners\NewLicensesRegistered;
use App\Models\Clients;
use App\Models\License;
use App\Models\Setting;
use App\Notifications\NewLicenseNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LicensesRemainderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\License;
     */
    protected $license;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $licenses = License::query()->with('client')->where('block', 0)->where('date', '>', Carbon::now())->get();
        foreach ($licenses as $license){
            $start_date = $license->created_at;
            $end_date = $license->date;

            $diffDays = $start_date->diffInDays($end_date);
            $now = Carbon::now()->diffInDays($end_date);
            $three_quarters = $diffDays / 3;

            // For First Three Months
            $first_time = $diffDays - $three_quarters;
            $second_time = $diffDays - ($three_quarters * 2);
            $third_time = $diffDays - ($three_quarters * 3);

            if ( $now == $first_time ) {
                // Code Here
            }elseif ($now == $second_time) {
                // Code Here
            }elseif($now == $third_time){
                // Code Here
            }elseif ($now <= 7) {
                // Code Here
            }
        }
    }
}
