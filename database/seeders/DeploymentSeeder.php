<?php

namespace Database\Seeders;

use App\Models\Deployment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deployment::factory(10)->create();
        // Deployment::insert([
        //     [
        //         'name' => 'Project A',
        //     ],
        //     [
        //         'name' => 'Project B',
        //     ],
        // ]);
    }
}
