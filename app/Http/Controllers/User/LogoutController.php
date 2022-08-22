<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Hash\HashController;
use DateTime;
use HashContext;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth as defaultAuth;

class LogoutController extends UserController
{
    public function logout()
    {
        // defaultAuth::logout();
        // return response()->json([
        //     'status' => 'success',
        //     'msg' => 'Logged out Successfully.'
        // ], 200);

        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
