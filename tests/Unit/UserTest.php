<?php

namespace Tests\Unit;

use App\Models\Auth;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    public function test_login_from()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_from()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = Auth::make([
            'name' => 'Mary',
            'email' => 'marytest@gmail.com',
        ]);
        $user2 = Auth::make([
            'name' => 'Annie',
            'email' => 'annietest@gmail.com',
        ]);
        $this->assertTrue($user1->name !== $user2->name);
        $this->assertTrue($user1->email !== $user2->email);
    }

    // 目前還沒有delete user功能
    // public function test_delete_user()
    // {
    //     $user = Auth::factory()->count(1)->make();
    //     $user = Auth::first();

    //     if ($user) {
    //         $user->delete();
    //     }
    //     $this->assertTrue(true);
    // }

    // http testing
    public function test_its_stores_new_users()
    {
        $response = $this->post('/register', [
            'name' => 'James',
            'email' => 'jamestest@gmail.com',
            'password' => 'james12345',
            'salt' => 'fdJ|skfL36ad%H*',
            'role' => 1
            // 'password_confirmation' => 'james12345'
        ])->assertRedirect('api/lel/f/all');
    }

    // database test for testing database.
    public function test_database()
    {
        $this->assertDatabaseHas('users', [
            'name' => "JessiH"
        ]);
    }

    // seeder test.
    public function test_if_seeders_works()
    {
        $this->seed();
    }
}
