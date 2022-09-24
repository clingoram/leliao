<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $name, string $message)
    {
        $this->name = $name;
        $this->message = $message;
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
        return new PrivateChannel('new-channel-name');
    }

    // 自訂廣播名稱
    // public function broadcastAs()
    // {
    //     return 'server.created';
    // }
}
