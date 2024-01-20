<?php

namespace Database\Seeders;

use App\Models\Podcast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Podcast::factory(2)->create();
        Podcast::insert([
            [
                'name' => 'Close The Door'
            ],
            [
                'name' => 'Kasisolusi'
            ]
        ]);
    }
}
