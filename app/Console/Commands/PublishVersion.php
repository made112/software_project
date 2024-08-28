<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Versions;
use App\Jobs\SendEmailToClientsWithNewVersion;

class PublishVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:publihed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send remider emails to clients when new version publish';

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
        $versions = Versions::where('block',0)->where('publish_version',2)->where('date','<=',date('Y-m-d'))->get();
        if($versions){
            foreach($versions as $version){
                $checkJob = (new SendEmailToClientsWithNewVersion($version));
                $job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($checkJob);
                $version->publish_version = 1;
                $version->update();
            }
        }
        $this->warn('job is done');
    }
}
