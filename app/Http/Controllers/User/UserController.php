<?php

namespace App\Http\Controllers\User;

use App\Models\Auth as TableUser;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Auth as defaultAuth;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // // public $name;
    // // protected $email;
    // // protected $password;
    // protected $check;
    // protected $combineString;
    // protected $secret;

    // public function __construct(Request $data)
    // {
    //     $this->name = $data->form['name'];
    //     $this->email = $data->form['email'];
    //     $this->password = $data->form['password'];
    // }


    // private function setAttempt(string $pwd1, string $pwd2): void
    // {
    //     $this->combineString = sha1($pwd1 . $pwd2);
    //     $this->check = DB::table('users')->where('password', '=', $this->combineString)->exists();
    // }

    // private function getAttempt(): bool
    // {
    //     return $this->check;
    // }

    /**
     * 檢查資料庫內是否有該筆資料存在
     */
    public function checkUserIsset(string $mail)
    {
        try {
            $user = TableUser::where('email', $mail)->first();
            $this->secret = $user;
            return $this->secret;

            // return response()->json([
            //     'status' => true,
            //     'data' => [
            //         'id' => $user->id,
            //         'name' => $user->name,
            //         'email' => $user->email,
            //         'salt' => $user->salt,
            //         'role' => $user->role,
            //         'created_at' => $user->created_at,
            //         'updated_at' => $user->updated_at,
            //     ]
            // ]);
            // return [
            //     'id' => $user->id,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'salt' => $user->salt,
            //     'role' => $user->role
            // ];
        } catch (Exception $e) {
            dd($e);
        }
    }

    protected function createToken(object $user, int $status)
    {
        $token = $user->createToken('apiToken');
        return response()->json(
            [
                'user' => $user,
                'accessToken' => $token->plainTextToken,
                'expires_in' => date('Y/m/d H:i:s', time() + 10 * 60),
                'type' => 'Bearer'
            ],
            $status
        );
    }

    protected function validatorData(array $data)
    {
        $result = Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($result->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $result->errors()
            ], 422);
        } else {
            return response()->json(
                ['status' => true],
                200
            );
        }
    }
}
