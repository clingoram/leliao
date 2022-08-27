<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Hash\HashController;
use DateTime;
use HashContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends UserController
{
    public $name;
    protected $email;
    protected $password;

    private string $numbersAndAlphabets;
    private string $specialCharacters;
    private int $len;

    public function __construct(Request $request)
    {
        $this->name = $request->form['name'];
        $this->email = $request->form['email'];
        $this->password = $request->form['password'];
    }
    /**
     * 使用封裝，隨機產生的數字+英文字母+特殊符號，送到HashController組成salt
     * 把從HashController得到的salt+使用者打上的密碼用sha1組合在一起
     */
    public function generateHash()
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
    public function create()
    {
        $now = new DateTime();

        $check = parent::validatorData([$this->name, $this->email, $this->password]);

        parent::checkUserIsset($this->email);

        $salt = $this->generateHash();
        $pwdwithHash = sha1($this->password . $salt);
        // $pwdwithHash = sha1($request->password . $salt);

        // if ($check['status'] === true) {
        if ($check) {

            $user = new Auth();
            $user->name = $this->name;
            $user->email = $this->email;
            // $user->password = Hash::make($this->password);
            // $user->remember_token = $token;
            $user->password = $pwdwithHash;
            $user->salt = $salt;
            $user->created_at = $now;
            $user->role = null ? 1 : 2;
            $user->save();

            return parent::createToken($user, 201);
        } else {
            return response()->json([
                'status' => 'error',
                'errors' => $check->errors()
            ], 422);
        }
    }
}
