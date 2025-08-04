<?php

use CQRS\Products\Infrastructure\Controllers\GetFindProductController;
use CQRS\Products\Infrastructure\Controllers\PostCreateProductController;

Route::get('/cqrs/products', GetFindProductController::class);
Route::post('/cqrs/products', PostCreateProductController::class);
