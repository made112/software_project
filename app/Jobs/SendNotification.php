<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\SendNotification as MailNotification;
use App\Models\Clients;
use App\Models\Notifications;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clients = Clients::whereIn('id', $this->details['client_ids'])->chunk(10, function ($clients) {
            foreach ($clients as $client) {
                \Notification::send($client, new MailNotification($this->details['notification']));
            }
        });
        $this->details['notification']->update(['is_send'=>1,'status'=>1]);
    //        $this->save();
    //        Notifications::where('id', $this->details['notification']->id)->update(['is_send'=>1,'status'=>1]);

        // if($this->details['client']){
//            $all_clinets = Clients::query();
//            if($this->details['client']){
//                $all_clinets = $all_clinets->whereIn('id',$this->details['client']);
//            }
//            $all_clinets->chunk(10, function ($clients) {
//                foreach ($clients as $client) {
//                    \Notification::send($client, new MailNotification($this->details['notification']));
//                }
//            });
//            Notifications::where('id',$this->details['notification']->id)->update(['is_send'=>1,'status'=>1]);
        // }
    }
}
