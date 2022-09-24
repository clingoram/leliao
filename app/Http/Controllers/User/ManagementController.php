<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;

/**
 * 查看登入的使用者權限
 */
class ManagementController extends UserController
{
  /**
   *  檢查role
   */
  public function checkRole(Request $request)
  {
    // 檢查role
    parent::setCheckRole($request);
    // 取得檢查結果
    $result = parent::getCheckRole();
    $checkRole = json_decode(json_encode($result[0]), true);

    if ($checkRole['role'] === 2 and ($checkRole['role'] !== 0 or $checkRole['role'] !== 1)) {
      return $this->admin($request->id, $request->name);
    } else {
      return $this->member($request->id);
    }
  }

  /**
   * 管理員頁面
   * 
   * 管理員(role = 2)權限:
   * 可查看所有註冊會員資料(name、email、role、註冊時間、最近一次登入時間)
   * 
   */
  protected function admin(int $id, string $name)
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
   * 一般會員頁面
   * 
   * 會員權限:
   * 可查看自己的資料(註冊時間、帳號、email)、是否要刪除自己的帳號
   */
  protected function member(int $id)
  {
    $user = Auth::select(
      'users.name',
      'users.email',
      'users.role',
      'users.created_at',
      'users.updated_at'
    )->where('id', '=', $id)->get();

    return response()->json([
      'status' => true,
      'data_return' => $user
    ], 200);
  }

  /**
   * 會員自行刪除自己的帳號
   * soft delete
   */
  // public function selfDestroy()
  // {
  // }
}
