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

class UserController extends Controller
{
    // // public $name;
    // // protected $email;
    // // protected $password;

    public function __construct()
    {
        // $this->name = $data->form['name'];
        // $this->email = $data->form['email'];
        // $this->password = $data->form['password'];
    }

    /**
     * 檢查資料庫內是否有該筆資料存在
     */
    public function checkUserIsset()
    {
        // $sql = Auth::where('name', $this->name)->get();
        try {
            return Auth::select(['*'])
                ->where('name', $this->name)
                ->first();
        } catch (Exception $e) {
            dd($e);
        }


        // return response()->json(auth()->user());

        // $sql = Auth::find(1)->get();

        // $checkStatus = !empty($sq) and count($sql) !== 0 ? 'success' : 'fail';
        // $data = $checkStatus === 'success' ? $sql : null;

        // return response()->json([
        //     'status' => $checkStatus
        // ]);

        // isset
        // if (!empty($sql)) {
        //     // return false;
        //     return response()->json([
        //         'status' => 'error'
        //     ]);
        // }
        // return false;
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
