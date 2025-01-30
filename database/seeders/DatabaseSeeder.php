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
        User::factory(100)->create()->each(function ($user) {
            Profile::factory(1)->create(['user_id' => $user->id])->each(function ($profile) {
                Address::factory(1)->create(['profile_id' => $profile->id]);
            });
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        Tag::factory(10)->create();

        $this->call(
            [
                CategorySeeder::class,
                PostSeeder::class,
                CourseSeeder::class,
            ]
        );
    }
}
