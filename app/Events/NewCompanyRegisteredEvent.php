<?php

namespace App\Events;

use App\Models\Clients;
use App\Models\ProjectsManager;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewCompanyRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Clients
     */
    public $client;

    /**
     * @var \App\Models\Setting
     */
    public $setting;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Clients $client, Setting $setting)
    {
        $this->client = $client;
        $this->setting = $setting;
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
