<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;

/**
 * Admin.
 */
class AdminController extends UserController
{
  protected $chekResult;

  public function check(int $id, String $name)
  {
    // $this->setCheckRole($id, $name);
    // $result = $this->getCheckRole();

    // return $result;

    return Auth::where('id', $id)->where('name', $name)->where('role', 2)->exists();
  }

  public function setCheckRole(int $id, String $name): void
  {
    $this->chekResult = Auth::where('id', $id)->where('name', $name)->where('role', 2)->exists();
  }

  public function getCheckRole(): bool
  {
    return $this->chekResult;
  }


  public function admin()
  {
    if ($this->chekResult === true) {
      // get all users
      $user = Auth::all();
      return $user;
    }
  }
}
