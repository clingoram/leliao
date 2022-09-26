<?php

namespace App\Http\Controllers\Chat;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;

/**
 * 取得目前會員名單
 */
class ContactController
{
    /**
     * 檢查目前登入者role
     */
    public function check(Request $request)
    {
        // 檢查role
        $role = new UserController();
        $role->setCheckRole($request);
        // 取得檢查結果
        $result = $role->getCheckRole();
        $checkRole = json_decode(json_encode($result[0]), true);

        if ($checkRole['role'] === 2 and ($checkRole['role'] !== 0 or $checkRole['role'] !== 1)) {
            return $this->adminRole($request->id, $request->name);
        } else {
            return $this->memberRole();
        }
    }

    /**
     * 管理員可取得所有role名單
     */
    public function adminRole(int $id, string $name)
    {
        $allData = Auth::select(
            'users.name',
            'users.email',
            'users.role',
            'users.created_at',
            'users.updated_at'
        )->where('id', '!=', $id)
            ->where('name', '!=', $name)
            ->where('deleted_at', '=', null)
            ->get();

        if (count($allData) >= 1) {
            return response()->json([
                'status' => true,
                'data_return' => $allData
            ], 200);
        } else {
            return response()->json([
                'status' => false,
            ], 200);
        }
    }

    /**
     * 會員只可取得同樣是會員的名單，不能看到管理員有誰
     */
    public function memberRole()
    {
        $user = Auth::select(
            'users.id',
            'users.name'
        )->where('role', '!=', 2)->get();

        return response()->json([
            'status' => true,
            'data_return' => $user
        ], 200);
    }
}
