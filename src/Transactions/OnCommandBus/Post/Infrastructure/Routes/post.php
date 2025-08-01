<?php

use Transactions\OnCommandBus\Post\Infrastructure\Controllers\PostCreatePostController;

Route::post('/posts', PostCreatePostController::class)->name('api.posts.create');
