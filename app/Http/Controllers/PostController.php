<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // dd(request(['search']));
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )
                ->paginate()->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $attributes['user_id'] = auth()->id();
        $post = new Post($attributes);

        // Using setSlugAttribute
        $post->slug = Str::random(rand(18, 24));

        // Persist
        $post->save();

        return redirect("/post/{$post->slug}")->with('success', 'Here\'s the post you just created!');
    }

    public function categorise()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )
                ->paginate()->withQueryString()
        ]);
    }
}
