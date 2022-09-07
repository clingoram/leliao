<?php

namespace Tests\Unit;

use App\Models\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        // 呼叫父類別的 setUp()
        parent::setUp();
        $this->initDatabase();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();
        // 呼叫子類別的 tearDown()
        parent::tearDown();
    }

    // HTTP test start.
    public function test_basic_test()
    {
        $this->get('/laliao/')->assertStatus(200);

        // $response->ddHeaders();

        // $response->ddSession();

        // $response->dd();
    }

    public function test_login_from()
    {
        $this->get('/login')->assertStatus(200);
    }

    public function test_register_from()
    {
        $this->get('/register')->assertStatus(200);
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

    public function test_its_stores_and_redirest()
    {
        $this->post('/register', [
            'name' => 'James',
            'email' => 'jamestest@gmail.com',
            'password' => 'james12345',
            'salt' => 'fdJ|skfL36ad%H*',
            'role' => 1
        ])->assertLocation('/');
    }

    public function test_register_user()
    {
        $data = new Auth();
        $data->name = 'James';
        $data->email = 'jamestest@gmail.com';
        $data->password = 'james12345';
        $data->salt = 'fdJ|skfL36ad%H*';
        $data->created_at = date('Y/m/d H:i:s', time());
        $data->role = 1;
        $saved = $data->save();
        $this->assertTrue($saved);
    }

    // Database test.
    public function test_database_count_data()
    {
        // $this->assertDatabaseHas('users', [
        //     'name' => "Jessi H",
        // ]);
        $this->assertDatabaseCount('users', 5);
    }

    // seeder test.
    // public function test_if_seeders_works()
    // {
    //     $this->seed();
    // }
}
