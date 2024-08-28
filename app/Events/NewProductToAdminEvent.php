<?php

namespace App\Events;

use App\Models\Setting;
use App\Models\Products;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewProductToAdminEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Setting;
     */
    public $admin;

    /**
     * @var Products
     */
    public $product;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Setting $admin, Products $product)
    {
        $this->admin = $admin;
        $this->product = $product;
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
