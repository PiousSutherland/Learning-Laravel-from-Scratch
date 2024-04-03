<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/post/{post:slug}', [PostController::class, 'show']);

Route::post('/post/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest')->name('login');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Admin
Route::middleware('can:admin')->group(function (){
    Route::get('/admin/posts', [AdminPostController::class, 'index']);
    Route::post('/admin/posts', [AdminPostController::class, 'store']);
    Route::get('/admin/posts/create', [AdminPostController::class, 'create']);
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy']);
});