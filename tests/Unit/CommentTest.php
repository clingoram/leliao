<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends TestCase
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

    public function test_add_comment()
    {
        $data = Comment::make();
        $categoryId = Category::first();
        $postId = Post::first();

        $this->post("api/lel/f/" . $categoryId . "/post/r/" .
            $postId, [
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'post_id' => $data['post_id'],
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'content' => $data['content'],
            'likeit' => $data['likeit'],
            'created_at' => $data['created_at']
        ])->assertLocation('/');
    }

    public function test_database_count_data()
    {
        $this->assertDatabaseCount('comments', 7);
    }
}
