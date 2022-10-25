<?php

use App\Models\Auth;
use Illuminate\Support\Facades\Broadcast;

use App\Models\PrivateMessage;
use App\Models\PublicMessage;
use App\Models\Conversation;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Private
Broadcast::channel('private-chat.{id}', function ($senderUser, $chatId, $receiverUser) {
    return true;
    // return $senderUser->id === PrivateMessage::findOrNew($receiverUser)->user_id;
});
Broadcast::channel('notification.{id}', function ($user, $id) {
    return true;
    // return $senderId->id === Conversation::findOrNew($receiverId)->id;
});

// Public
// Broadcast::channel('public-chat.{id}', function ($user, $message) {
//     return true;
//     // return $user->name === PublicMessage::findOrNew($receiverUser)->user_id;
// });

// test
Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    return $user->id === Post::findOrNew($orderId)->user_id;
});
