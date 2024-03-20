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
        User::factory()->create();

        Category::factory(6)->create();

        for ($i = 1; $i <= 6; $i++)
            for ($j = 1; $j <= 6; $j++)
                Post::factory()->create([
                    'user_id' => $j,
                    'category_id' => $i
                ]);
    }
}
