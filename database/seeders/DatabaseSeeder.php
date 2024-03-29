<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Phone;
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
            'email' => 'arman@example.net',
            'vip' => true
        ]);

        Phone::create([
            'foreign_user_id' => 1,
            'phone' => '(+62) 812 4567 890'
        ]);

        $this->call([
            UserSeeder::class,
            PhoneSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            OrderSeeder::class,
            ProductSeeder::class,
            PriceSeeder::class,
            MechanicSeeder::class,
            CarSeeder::class,
            OwnerSeeder::class,
            ProjectSeeder::class,
            EnvironmentSeeder::class,
            DeploymentSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,
            PodcastSeeder::class,
            PodcastUserSeeder::class
        ]);
    }
}
