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
    parent::setCheckRole($request);
    $result = parent::getCheckRole();
    // var_dump(json_decode(json_encode($result[0]), true));
    $checkRole = json_decode(json_encode($result[0]), true);

    if ($checkRole['role'] === 2) {
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
   * 刪除使用者?
   * 
   * 可看所有文章
   */
  public function admin(int $id, string $name)
  {
    // $allData = Auth::select(
    //   'users.name',
    //   'users.email',
    //   'users.role',
    //   'users.created_at',
    //   'users.updated_at'
    // )->where('id', '!=', $id)->where('name', '!=', $name)->get();

    $allData = Auth::select(
      'users.id',
      'users.name',
      'users.email',
      'users.role',
      'users.created_at',
      'users.updated_at'
    )->get();

    if (count($allData) >= 1) {
      return response()->json([
        'status' => true,
        'data' => $allData
      ], 200);
    }
  }

  /**
   * 一般會員頁面
   * 
   * 會員權限:
   * 可查看自己的資料(註冊時間、帳號、email)、是否要刪除自己的帳號
   */
  public function member(int $id)
  {
    Auth::find($id);
  }
}
