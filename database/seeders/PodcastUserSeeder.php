<?php

namespace Database\Seeders;

use App\Models\PodcastUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PodcastUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PodcastUser::factory(7)->create();
    }
}
