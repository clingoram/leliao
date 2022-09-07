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
            'password' => fake()->unique()->password(), //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'salt' => fake()->password(),
            'role' => 1
        ];
    }
}
