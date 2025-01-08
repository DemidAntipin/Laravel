<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class);
Route::get('/', [PostController::class, 'index']);

Route::post('posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts_suspicious', [PostController::class, 'moderating'])->name('posts.moderating');
Route::get('/posts_unpublished', [PostController::class, 'publish_available'])->name('posts.queue');
Route::get('/posts_decline', [PostController::class, 'declined'])->name('posts.declined');

Route::put('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
Route::put('posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
Route::put('posts/{post}/check', [PostController::class, 'check'])->name('posts.check');
