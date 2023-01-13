<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Conversation;
use App\Models\Auth;

/**
 * 通知
 */
class Notification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $senderId; // 寄件人ID
    public $senderUserName; // 寄件人姓名
    public $receiverId; // 收件人ID

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Auth $user, string $senderName, int $receiverId)
    {
        $this->senderId = $user;
        $this->senderUserName = $senderName;
        $this->receiverId = $receiverId;
    }

    /**
     * Get the channels the event should broadcast on.
     * 設定要廣播到哪個頻道
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');

        // 廣播頻道有三種可以選: Channel/PrivateChannel/PresenceChannel
        // Channel 代表任何使用者都可以訂閱的公共頻道，而 PrivateChannel 和 PresenceChannel 則代表需要授權的私人頻道。
        return new PrivateChannel('notification.', $this->receiverId);
    }

    /**
     * 自訂廣播名稱，需在client使用.listen
     */
    public function broadcastAs()
    {
        return 'NewMessage';
    }
}
