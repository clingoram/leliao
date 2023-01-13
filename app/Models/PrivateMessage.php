<?php

namespace App\Models;

use App\Models\Auth;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(Auth::class);
    }
}
