<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_add_a_post_path()
    {
        $this->get('/add_post')->assertStatus(200);
    }

    public function test_add_post()
    {
        $data = Post::make();
        $this->post("api/lel/add_post", [
            'title' => $data['title'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'writer_id' => $data['writer_id'],
            'created_at' => $data['created_at']
        ])->assertLocation('/');
    }

    public function test_database_count_data()
    {
        $this->assertDatabaseCount('posts', 1);
    }
}
