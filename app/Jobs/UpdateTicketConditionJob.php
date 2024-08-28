<?php

namespace App\Jobs;

use App\Models\Reply;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateTicketConditionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


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
        $tickets = Ticket::all();

        foreach ( $tickets as $ticket ) {
            $replies = Reply::where('ticket_id', $ticket->id)->count();

            $time = $ticket->created_at->addMinute();

            $current_time = Carbon::now();

            if ($replies == 0 && $time <= $current_time) {
                $ticket->update([
                    'condition' => 3,
                ]);
            }
        }
    }

    /**
     * @return int
     */
    public function backoff()
    {
        return 3;
    }
}
