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

    protected $check;
    protected $combineString;
    protected $secret;


    // public function __construct(Request $request)
    // {
    //     $this->email = $request->loginForm['email'];
    //     $this->pwd = $request->loginForm['password'];
    // }

    private function setAttempt(string $pwd1, string $pwd2): void
    {
        $this->combineString = sha1($pwd1 . $pwd2);
        $this->check = DB::table('users')->where('password', '=', $this->combineString)->exists();
    }

    private function getAttempt(): bool
    {
        return $this->check;
    }


    public function login(Request $request)
    {
        $checkUser = parent::checkUserIsset($request->email);
        // $user = Auth::where('email', $request->email)->first();

        // parent::setAttempt($request->password, $checkUser['salt']);
        // $attempt = parent::getAttempt();

        $this->setAttempt($request->password, $checkUser['salt']);
        $attempt = $this->getAttempt();
        // var_dump($attempt);
        // var_dump($checkUser['salt']);

        if ($attempt === true) {
            // $token = $checkUser->createToken('apiToken')->plainTextToken;
            // $token_expire_time = date('Y/m/d H:i:s', time() + 10 * 60);

            // return response()->json(
            //     [
            //         'status' => 'success',
            //         'user' => $checkUser,
            //     ],
            //     200
            // )->header('Authorization', $token);

            // return response()->json(
            //     [
            //         'status' => 'success',
            //         'user' => $checkUser,
            //         // 'token' => $token
            //     ],
            //     200
            // );

            return parent::createToken($checkUser, 200);
        }
        return response()->json(
            ['error' => 'login_error'],
            401
        );
    }
}
