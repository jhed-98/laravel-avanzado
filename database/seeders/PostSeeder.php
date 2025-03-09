<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(50)->create()->each(function ($post) {
            $post->images()->create([
                'url' => 'posts/' . $post->id . '.jpg',
            ]);

            $post->comments()->create([
                'body' => 'Un comentario de prueba',
                'user_id' => 1,
            ]);
        });
    }
}
