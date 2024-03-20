<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);
        User::factory()->create(['name' => 'Jack Doe']);
        User::factory()->create(['name' => 'Jenny Doe']);
        User::factory()->create(['name' => 'Jones Doe']);

        Category::factory(5)->create();

        Post::factory(30)->create([
            'user_id' => rand(1, 5),
            'category_id' => rand(1, 5)
        ]);
    }
}
