<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(30),
            'body' => $this->faker->realText(300),
            'image_path' => $this->faker->image('storage/app/public/images', 320, 240, null, false),
            'user_id' => User::factory(),
        ];
    }
}
