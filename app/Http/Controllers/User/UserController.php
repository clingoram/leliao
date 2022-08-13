<?php

namespace App\Http\Controllers\User;

use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

abstract class UserController extends Controller
{
    public $name;
    protected $email;
    protected $password;

    public function __construct(Request $data)
    {
        $this->name = $data->form['name'];
        $this->email = isset($data->form['email']) and !empty($data->form['email']) ? $data->form['email'] : null;
        $this->password = $data->form['password'];
    }

    /**
     * 檢查資料庫內是否有該筆資料存在
     */
    public function checkUserExist(): bool
    {
        $sqlName = Auth::where('name', $this->name)->get();
        $sqlEmail = Auth::where('email', $this->email)->get();

        if ($sqlName or $sqlEmail) {
            // found user
            return true;
        };
        return false;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function registerValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    public function loginValidator(Request $request)
    {
        return Validator::make($request, [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
