<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(
            [
                UserSeeder::class,
                CategorySeeder::class,
                PostSeeder::class,
                CourseSeeder::class,
                TagSeeder::class,
            ]
        );

        // Tag::factory(10)->create();

        // $this->call(CourseSeeder::class,);
    }
}
