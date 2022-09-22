<?php

namespace Database\Factories;

use App\Models\Auth;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text($maxNbChars = 50),
            'content' => fake()->realText($maxNbChars = 150, $indexSize = 2),
            'category_id' => Category::all()->random()->id,
            'writer_id' => Auth::all()->random()->id,
            'created_at' => date('Y/m/d H:i:s', time()),
        ];
    }
}
