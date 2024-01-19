<?php

namespace Database\Seeders;

use App\Models\Environment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Environment::factory(3)->create();
        Environment::insert([
            [
                'project_id' => 1,
                'name' => "Production"
            ],
            [
                'project_id' => 1,
                'name' => "Staging"
            ],
            [
                'project_id' => 2,
                'name' => "Production"
            ],
            [
                'project_id' => 2,
                'name' => "Testing"
            ],
        ]);
    }
}
