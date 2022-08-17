<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth as defaultAuth;

class UserController extends Controller
{
    // public $name;
    // protected $email;
    // protected $password;

    // public function __construct(Request $data)
    // {
    //     $this->name = $data->form['name'];
    //     // $this->email = $data->form['email'];
    //     // $this->password = $data->form['password'];
    // }

    /**
     * 檢查資料庫內是否有該筆資料存在
     */
    public function checkUser()
    {
        $sql = Auth::where('name', $this->name)->get();
        // $sqlEmail = Auth::where('email', $this->email)->dd();

        $checkStatus = !empty($sq) and count($sql) !== 0 ? 'success' : 'fail';
        $data = $checkStatus === 'success' ? $sql : null;

        return response()->json([
            'status' => $checkStatus,
            'data' => $data
        ]);
    }

    /**
     * 若過期則refresh token
     */
    public function refresh()
    {
        if ($token = defaultAuth::refresh()) {
            return response()
                ->json(
                    ['status' => 'successs'],
                    200
                )
                ->header('Authorization', $token);
        }
        return response()->json(
            ['error' => 'refresh_token_error'],
            401
        );
    }


    protected function guard()
    {
        return defaultAuth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function registerValidator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:30'],
    //         'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed']
    //     ]);
    // }

    // protected function loginValidator(array $data)
    // {
    //     return Validator::make($data, [
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    protected function validatorData(array $data)
    {
        $v = Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
    }
}
