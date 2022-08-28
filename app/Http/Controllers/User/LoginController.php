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
use Illuminate\Support\Facades\DB;


class LoginController extends UserController
{
    private $check;
    private $combineString;

    /**
     * setter
     * 登入檢查
     */
    private function setAttempt(string $pwd1, string $pwd2): void
    {
        $this->combineString = sha1($pwd1 . $pwd2);
        $this->check = DB::table('users')->where('password', '=', $this->combineString)->exists();
    }

    /**
     * getter
     * 登入檢查結果
     */
    private function getAttempt(): bool
    {
        return $this->check;
    }

    /**
     * 登入
     * 
     * @return json
     */
    public function login(Request $request)
    {
        $checkUser = parent::checkUserIsset($request->loginForm['email']);
        // $user = Auth::where('email', $request->email)->first();

        $this->setAttempt($request->loginForm['password'], $checkUser['salt']);
        $attempt = $this->getAttempt();

        $filterData = [
            $checkUser->name,
            $checkUser->email
        ];

        if ($attempt === true) {
            return parent::createToken($checkUser, 200);
        }
        return response()->json(
            ['error' => 'login_error'],
            401
        );
    }
}
