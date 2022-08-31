<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Logout user.
 */
class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'success',
                'message' => $request->user()->name . ' logged Out. At ' . date('Y/m/d H:i:s', time()),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Fail to logged Out. At ' . date('Y/m/d H:i:s', time()),
                'error' => $th->getMessage()
            ], 401);
        }
    }
}
