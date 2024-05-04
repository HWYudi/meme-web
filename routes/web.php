<?php

use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotifController;
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
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/following', [PostController::class, 'following'])->name('posts.index');
Route::post('/inertia', [PostController::class, 'store'])->name('posts.store')->middleware('checkauth');
Route::patch('/post/{id}', [PostController::class, 'update']);
Route::delete('/post/{id}', [PostController::class, 'destroy']);
Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like')->middleware('checkauth');
Route::delete('/posts/{id}/unlike', [PostController::class, 'unlike'])->name('posts.delete')->middleware('checkauth');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store')->middleware('checkauth');
Route::post('/reply', [CommentController::class, 'reply'])->middleware('checkauth') ;

//for profile
Route::get('/profile/{name}', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile/{name}' , [AuthController::class , 'follow']);
Route::get('profile/{name}/{id}' , [AuthController::class , 'post'])->name('profile.post');
Route::put('/profile/{name}', [AuthController::class, 'update']);
Route::get('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/user' , [AuthController::class , 'user']);

//for chat
Route::get('/messages' , [ChatController::class , 'index']);
Route::get('/inbox' , [ChatController::class , 'index']);
Route::get('/message/{name}' , [ChatController::class , 'chat']);
Route::get('/chat/{name}' , [ChatController::class , 'chat']);
Route::post('/chat' , [ChatController::class , 'store']);

//for admin
Route::get('/dashboard' , [AdminController::class , 'dashboard'])->name('dashboard')->middleware('admin');
Route::get('/dashboard/search' , [AdminController::class , 'search'])->middleware('admin');

Route::get('/inertia' , [PostController::class , 'inertia'])->name('inertia');
Route::get('/{name}/post/{id}' , [PostController::class , 'detailpost'])->name('detailpost');
