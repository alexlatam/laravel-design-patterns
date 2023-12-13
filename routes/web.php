<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/articles', ArticleController::class);

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

// Insert a new sale into the database and get the same sale using CQRS pattern
Route::get('/cqrs', SalesController::class);

Route::get('docs/exceptions/{code}', fn ($code) => $code)->name('docs.exceptions');
