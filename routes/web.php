<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');

Route::get('/users', [UserController::class, 'users'])->name('users');

