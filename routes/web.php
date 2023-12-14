<?php

use App\Criteria\FilterOperator;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GetUsersByCriteriaController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;

Route::get('/articles', ArticleController::class);

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

// Insert a new sale into the database and get the same sale using CQRS pattern
Route::get('/cqrs', SalesController::class);

Route::get('docs/exceptions/{code}', fn ($code) => $code)->name('docs.exceptions');

Route::get('/articles', ArticleController::class);
Route::get('/articles-all', fn() => Product::getAll());

Route::get('/users-criteria', GetUsersByCriteriaController::class);
