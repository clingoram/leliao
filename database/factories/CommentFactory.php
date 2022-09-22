<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Auth;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => Post::all()->random()->id,
            'name' => Auth::all()->random()->name,
            'category_id' => Category::all()->random()->id,
            'user_id' => Auth::all()->random()->id,
            'content' => fake()->realText($maxNbChars = 120, $indexSize = 2),
            'likeit' => fake()->randomDigit(),
            'created_at' => date('Y/m/d H:i:s', time()),
        ];
    }
}
