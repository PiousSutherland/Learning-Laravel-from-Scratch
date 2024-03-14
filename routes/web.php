<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts');
});

Route::get('/post/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/$slug.html";

    try {
        $post = cache()->remember("posts.$slug", 5 /* seconds */, fn () => file_get_contents($path));
    } catch (Exception $e) {
        echo "<script>console.log('$e)</script>";
        abort(404);
    }

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z\-_]+');
