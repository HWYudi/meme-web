<?php

use App\Http\Controllers\AjaxController;
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

//for authentication
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//for posts
Route::get('/', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/following', [PostController::class, 'following'])->name('posts.index');
Route::post('/', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::patch('/post/{id}', [PostController::class, 'update']);
Route::delete('/post/{id}', [PostController::class, 'destroy']);
Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');
Route::post('/reply', [CommentController::class, 'reply']);

//other
Route::get('/profile/{name}', [AuthController::class, 'profile'])->name('profile');
Route::get('profile/{name}/{id}' , [AuthController::class , 'post'])->name('profile.post');
Route::put('/profile/{name}', [AuthController::class, 'update']);
Route::get('/search', [PostController::class, 'search'])->name('posts.search');

Route::get('/tes' , function () {
    notify()->success('Welcome to Laravel Notify ⚡️') or notify()->success('Welcome to Laravel Notify ⚡️', 'My custom title');
    return view('tes');
});
Route::get('/user' , [AuthController::class , 'user']);
