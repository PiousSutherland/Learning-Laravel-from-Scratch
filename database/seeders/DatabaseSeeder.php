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
        User::truncate();
        Category::truncate();
        Post::truncate();
        
        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal', 
            'slug' => 'personal'
        ]);
        $work = Category::create([
            'name' => 'Work', 
            'slug' => 'work'
        ]);
        $hobby = Category::create([
            'name' => 'Hobby', 
            'slug' => 'hobbies'
        ]);
        
        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My Family Post',
            'slug' => 'my-family-post',
            'excerpt' => 'Lorem ipsum dolor sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, totam voluptas. Impedit dignissimos id nobis ipsam sint, tempore, voluptates facilis soluta error deserunt aspernatur recusandae ipsum reiciendis odio numquam molestiae?</p>'
        ]);
        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My Work Post',
            'slug' => 'my-work-post',
            'excerpt' => 'Lorem ipsum dolor sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, totam voluptas. Impedit dignissimos id nobis ipsam sint, tempore, voluptates facilis soluta error deserunt aspernatur recusandae ipsum reiciendis odio numquam molestiae?</p>'
        ]);
    }
}
