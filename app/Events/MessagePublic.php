<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * 群組
 */
class MessagePublic implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username; // 發訊息人姓名
    public $message; // 訊息內容

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $userName, string $message)
    {
        $this->username = $userName;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return new Channel('public-chat');
    }

    // add
    public function broadcastWith()
    {
        return [
            'user' => $this->username,
            'message' => $this->message
        ];
    }
}
