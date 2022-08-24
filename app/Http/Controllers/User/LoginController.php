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
    protected $email;
    protected $pwd;
    // private $secret;

    // public function __construct(Request $request)
    // {
    //     $this->email = $request->loginForm['email'];
    //     $this->pwd = $request->loginForm['password'];
    // }

    public function login(Request $request)
    {
        parent::checkUserIsset();
        // $check = parent::checkUserIsset();

        $user = Auth::where('email', $request->email)->first();

        // if (!$user || !Hash::check($validated['password'], $user['password'])) {
        //     return response([
        //         'message' => 'The provided credentials are incorrect.'
        //     ], Response::HTTP_UNAUTHORIZED);
        // }

        // $token = $user->createToken('apiToken')->plainTextToken;
        // return response()->json(
        //     ['status' => 'success'],
        //     200
        // )->header('Authorization', $token);
    }
}
