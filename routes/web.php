<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AboutController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);