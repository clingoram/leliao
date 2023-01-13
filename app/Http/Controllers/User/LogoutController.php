<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 使用者登出
 */
class LogoutController extends Controller
{
    /**
     * token 未過期
     */
    public function logout(Request $request)
    {
        try {
            // session_destroy();
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

    /**
     * 過期token 
     */
    // public function destroy()
    // {
    //     $deleted = DB::table('personal_access_tokens')->where('id', '=', 1)->delete();
    // }
}
