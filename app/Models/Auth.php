<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;

use App\Models\PrivateMessage;
use App\Models\Conversation;

class Auth extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function message()
    {
        return $this->hasMany(PrivateMessage::class);
    }

    public function conversation()
    {
        return $this->hasMany(Conversation::class);
    }

    // 複寫HasAccessToken createToken
    public function createToken(string $name, $abilities = ['*'], $expires_at = null)
    {
        $expires_at = $expires_at ?: config('sanctum.expiration');
        // $expires_at = $expires_at ?: env("SANCTUM_TTL");


        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,
            'expires_at' => now()->addHours($expires_at) // token過期時間為登入時間-2小時
        ]);
        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }
}
