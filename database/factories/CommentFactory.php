<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'foreign_post_id' => mt_rand(1, 20),
            'foreign_user_id' => mt_rand(1, 4),
            'comment' => fake()->paragraph()
        ];
    }
}
