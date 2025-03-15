<?php

namespace Database\Factories;

use App\Enums\PostPublished;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        $published = fake()->randomElement([
            PostPublished::Borrador->value,
            PostPublished::Publicado->value,
        ]);
        $published_at = $published === PostPublished::Publicado->value ? now() : null;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->text(200),
            'body' => fake()->text(2000),
            'image_path' => fake()->imageUrl(1280, 720),
            'published' => $published,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'published_at' => $published_at,
        ];
    }
}
