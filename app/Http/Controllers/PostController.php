<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

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
