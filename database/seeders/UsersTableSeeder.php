<?php

namespace Database\Seeders;

use App\Models\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Auth();
        $user->name = 'Jessi H';
        $user->email = 'detettestts4@gmail.com';
        $user->password = Hash::make('password');
        $user->role = 1;
        $user->created_at = date('Y/m/d H:i:s', time());
        $user->updated_at = date('Y/m/d H:i:s', time());
        $user->save();
    }
}
