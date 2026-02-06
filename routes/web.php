<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScrollController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => inertia('Page/Home'))->middleware('auth');

/**
 * Пользователи
 */
Route::get('/login/', [UserController::class, 'login'])->name('login');
Route::post('/login/', [UserController::class, 'loginPost']);
Route::middleware('auth')->group(function () {
    Route::post('/logout/', [UserController::class, 'logout']);
    Route::resource('users', UserController::class)->scoped(['user' => 'username']);

    //Route::get('/', [BookController::class, 'index']);
})->where(['user' => '[a-zA-Z0-9]+']);