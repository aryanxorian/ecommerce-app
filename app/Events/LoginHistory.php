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

class LoginHistory
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * 
     * @var private instance of user login credentials
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param $user The user login credentials
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * 
     * @return The private instance of user login credentials
     */
    public function getUser()
    {
        return $this->user;
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
