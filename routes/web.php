<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/articles', ArticleController::class);

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});
