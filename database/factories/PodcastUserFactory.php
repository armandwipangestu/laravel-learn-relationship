<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PodcastUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => mt_rand(1, 4),
            'podcast_id' => mt_rand(1, 2),
            'approved' => mt_rand(0, 1),
            'priority' => mt_rand(1, 3)
        ];
    }
}
