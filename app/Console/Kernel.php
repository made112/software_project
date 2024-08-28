<?php

namespace App\Console;

use App\Jobs\LicensesRemainderJob;
use App\Jobs\UpdateTicketConditionJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command(\App\Console\Commands\LicenseReminder::class)->everyMinute();
//        $schedule->command(\App\Console\Commands\PublishVersion::class)->hourly();
//        $schedule->job(new LicensesRemainderJob())->everyMinute();
        $schedule->job(new UpdateTicketConditionJob())->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
