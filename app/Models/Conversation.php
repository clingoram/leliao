<?php

namespace App\Models;


use App\Models\PrivateMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function message()
    {
        return $this->hasMany(PrivateMessage::class);
    }

    public function user()
    {
        return $this->hasMany(Auth::class);
    }
}
