<?php

use DDD\RealExample\User\Infrastructure\Controllers\PostRegisterUserController;

Route::post('users', PostRegisterUserController::class);
