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
    var_dump($result['role']);

    // if ($result['role'] === 2) {
    //   $this->admin();
    // } else {
    //   $this->member($request->id);
    // }
    // return response()->json([
    //   'status' => true,
    //   'data' => $result
    // ], 200);

    // if ($result === 1) {
    //   // role = admin
    //   $this->admin();
    // } else {
    //   // role = member
    //   $this->member($request->id);
    // }
  }

  /**
   * 管理員頁面
   * 
   * 管理員(role = 2)權限:
   * 可查看所有註冊會員資料(name、email、註冊時間、最近一次登入時間)
   * 刪除使用者?
   * 
   * 可看所有文章
   */
  public function admin()
  {
    $allData = Auth::select(
      'users.name',
      'users.email',
      'users.created_at',
      'users.updated_at'
    )->where('deleted_at', '=', null)->get();

    return response()->json([
      'status' => true,
      'data' => $allData
    ], 200);
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
