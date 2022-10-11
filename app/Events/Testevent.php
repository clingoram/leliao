<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// test
use App\Models\Auth;

class Testevent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiverId;

    public $loginUser;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public function __construct(string $message, int $receiver)
    // {
    //     $this->message = $message;
    //     $this->receiverId = $receiver;
    // }

    public function __construct(Auth $user)
    {
        $this->loginUser = $user;
        // $this->receiverId = 2;
        $this->message = "Test New Message.";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('my-testchannel' . $this->loginUser->id);
    }

    public function broadcastAs()
    {
        //命名推播的事件
        return 'new-event';
    }
}
