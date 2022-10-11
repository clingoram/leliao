<?php

namespace App\Http\Controllers\Chat;

// use App\Models\Auth;
// use App\Models\PrivateMessage;
// use App\Models\Conversation;

use App\Events\MessagePublic;
use App\Models\PublicMessage;

use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

/**
 * public 聊天
 */
class PublicMessageController extends ChatController
{
  public function sendMessage(Request $request)
  {
    $checkReceiver = parent::checkIsset($request->inputMessage['receiver']);
    if ($checkReceiver === true) {

      // $redis = Redis::connection();
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

      $data = [
        'userid' => $request->inputMessage['sender'],
        'message' => $request->inputMessage['message'],
        // 'receiver' => $request->inputMessage['receiver']
      ];

      PublicMessage::create($data);

      // event
      // 每當新訊息時，會觸發MessagePublic事件，發送推播通知訂閱該群組的頻道
      event(new MessagePublic($request->inputMessage['sender'], $request->inputMessage['message']));

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
