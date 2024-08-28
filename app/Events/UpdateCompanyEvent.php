<?php

namespace App\Events;

use App\Models\Clients;
use App\Models\ProjectsManager;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UpdateCompanyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Clients
     */
    public $client;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Clients $client)
    {
        $this->client = $client;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
