<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth as defaultAuth;
use Illuminate\Support\Facades\Validator;
// use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class LoginController extends UserController
{
    protected $email;
    protected $pwd;

    public function __construct(Request $data)
    {
        $this->email = $data->loginForm['email'];
        $this->pwd = $data->loginForm['password'];
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd(json_encode($request->all));
        // $fake = ["email" => "jj.test@gmail.com", "password" => "js3tre3"];
        // $c = JWTAuth::attempt($credentials);
        // var_dump($c);
        // die();

        // if ($token = defaultAuth::attempt($fake)) {
        //     return response()->json(
        //         ['status' => 'success'],
        //         200
        //     )->header('Authorization', $token);
        // }
        // return response()->json(
        //     ['error' => 'login_error'],
        //     401
        // );

        if ($token = defaultAuth::attempt($credentials)) {
            return parent::respondWithToken($token);
        }

        return response()->json(
            ['error' => 'Unauthorized'],
            401
        );
    }
}
