<?php

namespace App\Http\Controllers\Chat;

// use App\Models\Auth;
// use App\Models\PrivateMessage;
// use App\Models\Conversation;

use Illuminate\Support\Facades\Redis;

// use App\Events\MessagePrivate;
// use App\Events\Notification;

use Illuminate\Http\Request;

/**
 * private 聊天
 */
class PrivateMessageController extends ChatController
{
    public function sendMessage(Request $request)
    {
        $checkReceiver = parent::checkIsset($request->inputMessage['receiver']);
        if ($checkReceiver === true) {

            $redis = Redis::connection();

            $data = [
                'sender' => $request->inputMessage['sender'],
                'message' => $request->inputMessage['message'],
                'receiver' => $request->inputMessage['receiver']
            ];

            // $redis->publish('message', json_encode($data));
            $redis->publish('sendChatToServer', json_encode($data));


            return response()->json(
                ['status' => true]
            );
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
