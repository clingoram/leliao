<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Auth;

use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    protected $secret;
    public $checkResult;


    /**
     * 檢查role
     */
    public function setCheckRole($data): void
    {
        $this->checkResult = Auth::select(
            'users.name',
            'users.email',
            'users.role',
            'users.created_at',
            'users.updated_at'
        )->where('id', '=', $data->id)->where('name', '=', $data->name)->get();
    }

    public function getCheckRole()
    {
        return $this->checkResult;
    }


    /**
     * 檢查table內是否有該筆資料存在
     * 
     * 註冊:沒該筆資料->可以註冊
     * 登入:沒該筆資料->不能登入
     */
    public function checkUserIsset(string $mail)
    {
        return Auth::where('email', '=', $mail)->exists();
    }

    public function setCookie(string $data)
    {
        $minutes = 10;
        // Cookie::queue('name', $data, $minutes);
        // return response('Set cookie');

        $cookie = cookie('name', $data, $minutes);
        response()->cookie($cookie);
    }

    public function getCookie()
    {
        $data = 'TT';
        $minutes = 60;
        // return Cookie::get('name');
        $cookie = cookie('name', $data, $minutes);
        return response()->cookie($cookie);
    }

    /**
     * 建立token
     * 
     * @return json
     */
    protected function createToken(object $user, int $statusCode, string $message)
    {

        if (isset($user) and !empty($user)) {
            $expires = date('Y/m/d H:i:s', time() + 10 * 60);
            // $token = $user->createToken($user->name)->plainTextToken;
            $token = $user->createToken($user->name);


            return response()->json(
                [
                    'status' => 'success',
                    'user' => [
                        'id' => $user->id,
                        'account' => $user->name
                    ],
                    // 'message' => $user->name . ' ' . $message,
                    'accessToken' => $token->plainTextToken,
                    'expires_at' => date('Y/m/d H:i:s', time() + 10 * 60),
                    'type' => 'Bearer',
                    'Accept' => 'application/json'
                ],
                $statusCode
            );

            // $response = response()->json([
            //     [
            //         'message' => $message,
            //         'access_token' => $token,
            //         'type' => 'Bearer',
            //         'Accept' => 'application/json'
            //     ],
            // ], $statusCode);
            // return $response->headers->setCookie($cookie);
        } else {
            return response()->json(
                [
                    'error' => 'token_error'
                ],
                401
            );
        }
    }

    /**
     * 過濾檢查
     * 
     * @param array $data
     * @return json
     */
    public function validatorData($data)
    {
        try {
            $result = Validator::make($data, [
                'name' => ['required', 'string', 'max:30'],
                'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
                'password' => ['required', 'string', 'min:7', 'max:20', 'confirmed']
            ]);

            if ($result->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validator error'
                ], 401);
            } else {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Success'
                    ],
                    200
                );
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
