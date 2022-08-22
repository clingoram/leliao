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
// use PHPOpenSourceSaver\JWTAuth\JWTAuth;
// use Illuminate\Support\Facades\Auth as dAuth;

use Illuminate\Support\Facades\DB;


class LoginController extends UserController
{
    // protected $email;
    // protected $pwd;
    // private $secret;
    // private $tokenPWD;
    // protected $jwtAuth;

    // public function __construct(JWTAuth $jwtAuth)
    // {
    // $this->jwtAuth = $jwtAuth;
    //     $this->email = $data->loginForm['email'];
    //     $this->pwd = $data->loginForm['password'];
    // }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        // dd($credentials);

        // $token = auth()->attempt($credentials);
        // $token = $this->guard->attempt($credentials);
        $token = Auth()->attempt($credentials);

        if (!$token) {
            return response()->json(
                [
                    'status' => 'error',
                    'error' => 'Unauthorized'
                ],
                401
            );
        }

        return $this->respondWithToken($token);
    }
}
