<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('/post/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});

Route::get('/category/{category:slug}', function (Category $cat) {
    return view('category', [
        'category' => $cat
    ]);
});
