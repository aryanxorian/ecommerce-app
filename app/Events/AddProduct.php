<?php

namespace EcommerceApp\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $product, $file;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product, $file)
    {
        //Log::error("Hello");
        $this->product = $product;
        $this->file = $file;
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

    public function getProduct()
    {
        return $this->product;
    }

    public function getFile()
    {
        return $this->file;
    }
}
