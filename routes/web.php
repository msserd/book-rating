<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookRatingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => inertia('Page/Home'))->middleware('auth');

//Общая страница книг
Route::get('/books', [BookController::class, 'index'])->name('books.index');

//Логин юзеров
Route::get('/login/', [UserController::class, 'login'])->name('login');
Route::post('/login/', [UserController::class, 'loginPost']);

Route::middleware('auth')->group(function () {
    //Юзеры
    Route::post('/logout/', [UserController::class, 'logout']);
    Route::resource('users', UserController::class)->scoped(['user' => 'username']);

    //Книги
    Route::resource('books', BookController::class)->except('index', 'show');
    Route::get('/my-books', [BookController::class, 'myBooks']);
    Route::post('/books/{book}/rate', [BookRatingController::class, 'rate'])->name('books.rate');

    //Сброс рейтинга
    Route::post('/ratings/reset-my', [BookRatingController::class, 'resetMy']);
    Route::post('/ratings/reset-all', [BookRatingController::class, 'resetAll']);
})->where(['user' => '[a-zA-Z0-9]+']);