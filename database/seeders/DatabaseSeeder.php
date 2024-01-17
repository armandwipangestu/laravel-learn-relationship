<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Arman Dwi Pangestu',
            'username' => 'devnull',
            'email' => 'arman@exampple.net',
        ]);

        $this->call([
            UserSeeder::class,
            PhoneSeeder::class,
            PostSeeder::class
        ]);
    }
}
