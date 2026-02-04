<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserlistController;
use App\Http\Controllers\TimeLineController;
use App\Models\Post;
use App\Http\Controllers\PostController;



Route::get('/userlist', [UserlistController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin|moderator'])
    ->name('userlist');
Route::get('/timeline/{page?}', [TimeLineController::class, 'index'])->name('timeline');
Route::get('/post/{post}', [TimeLineController::class, 'postShow'])->name('post');
Route::get('/ranking', [TimeLineController::class, 'ranking'])->name('ranking');

Route::middleware('auth', )->group(function () {
    Route::get('/profile/{user?}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{user?}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user?}', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/{user}/password', [ProfileController::class, 'updatePasswordAdmin'])
        ->middleware(['auth', 'role:admin'])
        ->name('profile.password.admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/post/{post?}', [PostController::class, 'view'])->name('post.view');
    Route::get('/post/{post?}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('post.like');
    Route::patch('/post/{post?}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post?}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::delete('/post', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comment/{comment}/like', [CommentController::class, 'like'])->name('comment.like');
    Route::patch('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/{page?}', [TimeLineController::class, 'index'])->name('timeline');