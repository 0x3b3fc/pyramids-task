<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::controller(PostController::class)->middleware('auth:sanctum')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('index', 'index')->name('posts.index');
        Route::post('store', 'store')->name('posts.store');
        Route::post('update/{id}', 'update')->name('posts.update');
        Route::delete('destroy/{id}', 'destroy')->name('posts.destroy');
    });
});
