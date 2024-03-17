<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('homepage');
});

Route::get('/register' , function () {
    return view('auth.register');
});

Route::post('/register' , [AuthController::class, 'register'])->name('register');


Route::get('/login' , function () {
    return view('auth.login');
});

Route::post('/login' , [AuthController::class , 'login'])->name('login');

Route::post('/' , [PostController::class , 'store'])->name('posts.store');

Route::get('/' , [PostController::class , 'index'])->name('posts.index');
