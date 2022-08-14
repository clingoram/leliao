<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Hash;

class RegisterController extends UserController
{
    // public $name;
    // protected $email;
    // private $password;

    // public function __construct(string $name, string $email, string $pwd)
    // {
    //     $this->name = $name;
    //     $this->email = $email;
    //     $this->password = $pwd;
    // }

    public function create()
    {
        $now = new DateTime();

        parent::registerValidator([$this->name, $this->email, $this->password]);

        if (parent::checkUserExist()) {
            $user = new Auth();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->created_at = $now;
            $user->save();
        } else {
            echo $this->name . '無法註冊。';
        }
    }
}
