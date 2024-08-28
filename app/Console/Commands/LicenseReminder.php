<?php

namespace App\Console\Commands;

use App\Jobs\FirstThirdTimeLicenseDateReminder;
use App\Jobs\LastThirdTimeLicenseDateReminder;
use App\Jobs\LicensesRemainderJob;
use App\Jobs\MiddleThirdTimeLicenseDateReminder;
use App\Jobs\SendEmailToClientsWhenCreateProductVersion;
use Illuminate\Console\Command;
use SebastianBergmann\Environment\Console;

class LicenseReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send remider emails to clients when license time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('job is running');
//        FirstThirdTimeLicenseDateReminder::dispatch();
//        LastThirdTimeLicenseDateReminder::dispatch();
//        MiddleThirdTimeLicenseDateReminder::dispatch();
//        SendEmailToClientsWhenCreateProductVersion::dispatch();
        LicensesRemainderJob::dispatch();
        $this->warn('job is done');
    }
}
