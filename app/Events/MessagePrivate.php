<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\PrivateMessage;

/**
 * 私人訊息
 */
class MessagePrivate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message; // 訊息內容
    public $senderId; // 寄件人ID
    public $conversationId; // 對話ID

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $message, int $senderId, int $conversationId)
    {
        $this->senderId = $senderId;
        $this->message = $message;
        $this->conversationId = $conversationId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('private-chat.' . $this->conversationId);
    }

    // add
    public function broadcastWith()
    {
        return [
            'senderId' => $this->senderId,
            'conversationId' => $this->conversationId,
            'message' => $this->message
        ];
    }
}
