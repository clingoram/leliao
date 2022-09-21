<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;

/**
 * User loggin.
 */
class LoginController extends UserController
{
    private $check;
    private $combineString;
    const Message_Note = 'Logged in.';

    /**
     * 登入檢查
     */
    private function setAttempt(string $pwd1, string $pwd2): void
    {
        $this->combineString = sha1($pwd1 . $pwd2);
        $this->check = Auth::where('password', '=', $this->combineString)->where('deleted_at', '=', null)->exists();
    }

    /**
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
        $checkUserIsset = parent::checkUserIsset($request->loginForm['email']);

        if ($checkUserIsset === true) {
            $user = Auth::where('email', $request->loginForm['email'])->first();

            // parent::validatorData($request);
            $this->setAttempt($request->loginForm['password'], $user['salt']);
            $attempt = $this->getAttempt();

            if ($attempt === true) {
                // $set = parent::setCookie($user['name']);
                // $getCookie = parent::getCookie();

                // updated_at更新為user登入時間
                Auth::where('id', $user['id'])
                    ->where('email', $user['email'])
                    ->update(['updated_at' => date('Y/m/d H:i:s', time())]);

                return parent::createToken($user, 200, self::Message_Note);
            } else {
                return;
            }
        }

        return response()->json(
            [
                'status' => false,
                'error' => '登入發生一些問題。'
            ],
            401
        );
    }
}
