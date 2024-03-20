<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $starting2 = '<p>' . implode('</p><p>', fake()->paragraphs(2)) . '</p>';
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'title' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'excerpt' => $starting2,
            'body' => $starting2 . '<p>' . implode('</p><p>', fake()->paragraphs(4)) . '</p>'
        ];
    }
}
