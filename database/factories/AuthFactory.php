<?php

namespace Database\Factories;

use App\Models\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auth>
 */
class AuthFactory extends Factory
{
    protected $model = Auth::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->unique()->password(),
            'salt' => fake()->password(),
            'role' => 1
        ];
    }
}
