<?php

namespace Database\Seeders;

use App\Models\Auth;
// use Database\Factories\AuthFactory;
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
        Auth::factory()->count(5)->create();
    }
}
