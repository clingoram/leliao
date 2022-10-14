<?php

namespace App\Http\Controllers\Chat;

use App\Events\Notification;
use App\Events\MessagePrivate;

use App\Models\Auth;
use App\Models\PrivateMessage;
use App\Models\Conversation;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Redis\Connectors\PhpRedisConnector;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * private 聊天
 */
class PrivateMessageController extends ChatController
{
    public $conversations;

    // public function index(Object $user)
    // {
    //     $userOne = Auth::find($user['sender']); // 寄
    //     $userTwo = $user['receiver']; // 收

    //     if ($userOne === $userTwo) {
    //         abort(404);
    //     }

    //     if (Conversation::where('userOne', $userOne)->where('userTwo', $userTwo)->first()) {
    //         $conversation = Conversation::where('userOne', $userOne)
    //             ->where('userTwo', $userTwo)
    //             ->first();
    //     } else if (Conversation::where('userOne', $userTwo)->where('userTwo', $userOne)->first()) {
    //         $conversation = Conversation::where('userOne', $userTwo)
    //             ->where('userTwo', $userOne)
    //             ->first();
    //     } else {
    //         Conversation::create([
    //             'userOne' => $userOne,
    //             'userTwo' => $userTwo
    //         ]);

    //         $conversation = Conversation::latest()->first();
    //     }

    //     $conversationId = $conversation->id;

    //     $messages = PrivateMessage::where(function ($query) use ($userTwo) {
    //         $query->where('userId', Auth::user()->id)
    //             ->orWhere('userId', $userTwo);
    //     })->where('conversation_id', $conversation->id)->get();

    //     $this->conversations = Conversation::where('userOne', Auth::user()->id)
    //         ->orWhere('userTwo', Auth::user()->id)
    //         ->get();

    //     return response()->json([
    //         'title' => 'Private Chat',
    //         'u' => Auth::find($userTwo),
    //         'conversations' => $this->conversations,
    //         'conversationId' => $conversationId,
    //         'messages' => $messages
    //     ]);
    // }

    // public function index()
    // {
    //     $userOne = Auth::find($user['sender']); // 寄
    //     $userTwo = $user['receiver']; // 收
    // }

    public function sendMessage(Request $request)
    {
        $checkReceiver = parent::checkIsset($request->inputMessage['receiver']);
        if ($checkReceiver === true) {

            $redis = Redis::connection(); // 從原先的port6379 改為6360

            // $data = [
            //     'sender' => $request->inputMessage['sender'],
            //     'message' => $request->inputMessage['message'],
            //     'receiver' => $request->inputMessage['receiver']
            // ];
            // // $redis->publish('message', json_encode($data));
            // $redis->publish('sendChatToServer', json_encode($data));
            // return response()->json(
            //     ['status' => true]
            // );

            // $chat = self::index($request);

            $data = [
                // 'conversationId' => $chat['conversationId'],
                'conversationId' => $request->inputMessage['conversationId'],
                'userId' => $request->inputMessage['sender'],
                'message' => $request->inputMessage['message']
            ];

            $redis->publish('message', json_encode($data));
            $redis->publish('sendPrivateChatToServer', json_encode($data));

            // PrivateMessage::create($data);

            // event
            event(new Notification($request->inputMessage['sender'], $request->inputMessage['senderName'], $request->inputMessage['receiver']));

            // 每當新訊息時，會觸發MessagePrivate事件，發送推播通知訂閱該群組的頻道
            event(new MessagePrivate($request->inputMessage['message'], $request->inputMessage['sender'], $request->inputMessage['conversationId']));
            return response()->json(
                [
                    'status' => true
                ],
                200
            );
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
