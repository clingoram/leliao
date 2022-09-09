<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $secret;

    // public function __construct(Request $data)
    // {
    //     $this->name = $data->form['name'];
    //     $this->email = $data->form['email'];
    //     $this->password = $data->form['password'];
    // }

    // public function index()
    // {
    //     $users = TableUser::all();
    //     return response()->json(
    //         [
    //             'status' => 'success',
    //             'users' => $users->toArray()
    //         ],
    //         200
    //     );
    // }

    // public function show(Request $request, int $id)
    // {

    // $user = TableUser::find($id);
    // return response()->json(
    //     [
    //         'status' => 'success',
    //         'user' => $user->toArray()
    //     ],
    //     200
    // );
    // }


    /**
     * 檢查table內是否有該筆資料存在
     * 
     * 註冊:沒該筆資料->可以註冊
     * 登入:沒該筆資料->不能登入
     */
    public function checkUserIsset(string $mail)
    {
        return DB::table('users')->where('email', '=', $mail)->exists();
    }

    /**
     * 建立token
     * 
     * @return json
     */
    protected function createToken(object $user, int $statusCode, string $message)
    {
        if (isset($user) and !empty($user)) {
            $token = $user->createToken($user->name)->plainTextToken;
            return response()->json(
                [
                    'status' => 'success',
                    'user' => [
                        'id' => $user->id,
                        'account' => $user->name
                    ],
                    'message' => $user->name . ' ' . $message,
                    'accessToken' => $token,
                    'expires_in' => date('Y/m/d H:i:s', time() + 10 * 60),
                    'type' => 'Bearer',
                    'Accept' => 'application/json'
                ],
                $statusCode
            );
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
                    'message' => 'Validator error',
                    // 'errors' => $result->errors()
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
