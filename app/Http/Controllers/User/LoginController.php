<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth as dAuth;
use Illuminate\Support\Facades\DB;


class LoginController extends UserController
{
    // protected $email;
    // protected $pwd;
    // private $secret;

    public function __construct()
    {
        // $this->email = $data->loginForm['email'];
        //     $this->pwd = $data->loginForm['password'];
    }

    public function login(Request $request)
    {
    }
}
