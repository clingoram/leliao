<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Hash;

class LoginController extends UserController
{
    protected $email;
    protected $pwd;

    public function __construct(Request $data)
    {
        $this->email = $data->form['email'];
        $this->pwd = $data->form['password'];
    }

    public function index(): void
    {
        parent::loginValidator([$this->email, $this->pwd]);

        parent::checkUserExist();
    }
}
