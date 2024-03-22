<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/following', [PostController::class, 'following'])->name('posts.index');

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/post', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');


Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');
Route::post('/reply', [CommentController::class, 'reply']);
