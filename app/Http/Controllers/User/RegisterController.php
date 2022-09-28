<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiAuth\ApiAuthController;
use App\Http\Controllers\Cookie\CookieController;
use App\Http\Controllers\Hash\HashController;

/**
 * 註冊
 */
class RegisterController extends UserController
{
    private string $numbersAndAlphabets;
    private string $specialCharacters;
    private int $len;
    /**
     * 隨機產生的數字+英文字母+特殊符號，送到HashController組成salt
     * 把從HashController得到的salt+使用者打上的密碼用sha1組合在一起
     */
    protected function generateHash(): string
    {
        $hash = new HashController();
        $this->numbersAndAlphabets = '0987654321abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->specialCharacters = '*/&^_[\(-+#$)@.{!]%}';
        $this->len = strlen($this->numbersAndAlphabets);

        $hash->setRandomSalt($this->numbersAndAlphabets, $this->specialCharacters, $this->len);
        $salt = $hash->getRandomSalt();
        return $salt;
    }

    /**
     * 建立新的使用者
     * 
     * @return json
     */
    public function create(Request $request)
    {
        parent::validatorData($request);

        $checkUserIsset = parent::checkUserIsset($request->form['email']);

        $salt = $this->generateHash();
        $pwdwithHash = sha1($request->form['password'] . $salt);

        // 資料表內是否已有role = 2
        $roleIsset = Auth::where('role', '=', 2)->get();

        if ($checkUserIsset === false) {
            $user = new Auth();
            $user->name = $request->form['name'];
            $user->email = $request->form['email'];
            $user->password = $pwdwithHash;
            $user->salt = $salt;
            $user->created_at = date('Y/m/d H:i:s', time());
            $user->role = $roleIsset->count() === 1 ? 1 : 2;
            $user->save();


            // $setCookie = new CookieController();
            // $cc = $setCookie->setCookie($user->name);
            // echo $cc->getCookie();

            $createToken = new ApiAuthController();
            return $createToken->createToken($user, 201);
        } else {
            return response()->json([
                'status' => 'error',
                'errors' => 'Something wrong.'
            ], 422);
        }
    }
}
