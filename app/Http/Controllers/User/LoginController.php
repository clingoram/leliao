<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends UserController
{
    protected $email;
    protected $pwd;

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // public function __construct(Request $data)
    // {
    //     $this->email = $data->form['email'];
    //     $this->pwd = $data->form['password'];

    //     $this->middleware('guest')->except('logout');
    // }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(): void
    {
        parent::loginValidator([$this->email, $this->pwd]);

        parent::checkUserExist();
    }
}
