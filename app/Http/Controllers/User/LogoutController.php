<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use HashContext;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LogoutController extends UserController
{
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged Out.',
        ], 200);
    }
}
