<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/post/{post:slug}', [PostController::class, 'show']);
