<?php

namespace App\Events;

use App\Models\Clients;
use App\Models\License;
use App\Models\Products;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLicensesRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Setting
     */
    public $setting;

    /**
     * @var \App\Models\Clients
     */
    public $client;

    /**
     * @var \App\Models\Products
     */
    public $product;

    /**
     * @var License
     */
    public License $license;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Clients $client, Setting $setting, Products $product, License $license)
    {
        $this->client = $client;
        $this->setting = $setting;
        $this->product = $product;
        $this->license = $license;
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
