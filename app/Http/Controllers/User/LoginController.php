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

use Illuminate\Support\Facades\DB;


class LoginController extends UserController
{
    protected $email;
    protected $pwd;
    // private $secret;
    // private $tokenPWD;

    // public function __construct(Request $data)
    // {
    //     $this->email = $data->loginForm['email'];
    //     $this->pwd = $data->loginForm['password'];
    // }

    public function login(Request $request)
    {
        // $data = Auth::where('email', $request->email)
        //     ->get();
        // foreach (json_decode(json_encode($data), true) as $key => $value) {
        //     var_dump($value);
        //     $this->secret = $value['salt'];
        // }
        // if (sha1($request->password . $this->secret)) {
        //     return true;
        // } else {
        //     return false;
        // }

        $credentials = $request->only(['email', 'password']);
        // dd($credentials);

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
