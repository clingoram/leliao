<?php

namespace App\Http\Controllers\Chat;

use App\Models\Auth;
use App\Models\PrivateMessage;
use App\Models\Conversation;

use App\Events\MessagePrivate;
use App\Events\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * private 聊天
 */
class PrivateMessageController extends ContactController
{
    //
    public function index()
    {
    }
}
