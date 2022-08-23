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

    public function create()
    {
        $now = new DateTime();

        // // parent::registerValidator([$this->name, $this->email, $this->password]);
        $check = parent::validatorData([$this->name, $this->email, $this->password]);
        // $check = parent::validatorData($request);

        // parent::checkUserIsset();

        $salt = $this->generateHash();
        $pwdwithHash = sha1($this->password . $salt);
        // if ($check['status'] === true) {
        if ($check) {

            // $user = new Auth();
            // $user->name = $this->name;
            // $user->email = $this->email;
            // // $user->password = Hash::make($this->password);
            // $user->password = $pwdwithHash;
            // $user->salt = $salt;
            // $user->created_at = $now;
            // $user->role = null ? 1 : 2;
            // $user->save();

            // $user = new Auth();
            // $user->name = $request->name;
            // $user->email = $request->email;
            // // $user->password = Hash::make($this->password);
            // $user->password = $pwdwithHash;
            // $user->salt = $salt;
            // $user->created_at = $now;
            // $user->role = 2 ? 2 : 1;
            // $user->save();

            $user = Auth::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $pwdwithHash,
                'salt' => $salt,
                'created_at' => $now,
                'role' => null ? 1 : 2
            ]);

            $token = $user->createToken('token')->plainTextToken;

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'user' => $user
                ],
            );

            // $user = $this->user_repository->registerAccount($this->name, $this->email, $this->password);

            // return response()->json(
            //     [
            //         'status' => 'success',
            //         'message' => 'User created successfully',
            //         'user' => $user,
            //         'authorisation' => [
            //             'token' => $token,
            //             'type' => 'bearer',
            //         ]
            //     ],
            //     200
            // );

            // $login = new LoginController();
            // // $token = $login->login(json_decode(json_encode($user), FALSE));
            // $token = $login->login($this->email, $this->password);

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'User created successfully',
            //     'user' => $user,
            //     'authorisation' => [
            //         'token' => $token,
            //         'type' => 'bearer',
            //     ]
            // ]);
        } /*else {
            // echo $this->name . '無法註冊。';
            return $check;
        }*/
    }
}
