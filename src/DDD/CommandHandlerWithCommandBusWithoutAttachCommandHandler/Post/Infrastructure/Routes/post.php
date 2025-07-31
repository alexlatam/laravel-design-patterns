<?php

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Infrastructure\Controllers\PostCreatePostController;

Route::post('/posts-second', PostCreatePostController::class)->name('api.posts.create-aux');
