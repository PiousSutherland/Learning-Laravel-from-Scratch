<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
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
        User::factory()->create(['name' => 'Jen Doe', 'password' => 'password']);
        User::factory()->create(['name' => 'Jack Doe']);
        User::factory()->create(['name' => 'Jane Doe']);
        User::factory()->create(['name' => 'Jewels Doe']);
        User::factory()->create(['name' => 'Jones Doe']);
        User::factory()->create([
            'name' => 'Pious Sutherland',
            'email' => 'pious.sutherland@ictglobe.com',
            'username' => 'psuth',
            'password' => 'password',
            'is_admin' => '1'
        ]);

        Category::factory(6)->create();

        $user_ids = User::pluck('id')->all();

        for ($i = 1; $i <= 6; $i++)
            for ($j = 1; $j <= 6; $j++) {
                $post = Post::factory()->create([
                    'category_id' => $i,
                    'user_id' => $j
                ]);

                for ($k = 0; $k < 3; $k++)
                    Comment::factory()->create([
                        'post_id' => $post->id,
                        'user_id' => $user_ids[array_rand($user_ids)]
                    ]);
            }
    }
}
