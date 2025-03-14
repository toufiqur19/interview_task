<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::get('/users', [UserController::class, 'users']);
});

Route::get('/users', [UserController::class, 'users']);
Route::get('/user/edit/{user_id}', [UserController::class, 'userEdit']);
Route::post('/user/update/{user_id}', [UserController::class, 'userUpdate']);
Route::get('/user/delete/{user_id}', [UserController::class, 'userDelete']);