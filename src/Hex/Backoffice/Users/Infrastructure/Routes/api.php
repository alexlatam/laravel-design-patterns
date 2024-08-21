<?php

use Hex\Backoffice\Users\Infrastructure\Controllers\CreateUserController;
use Illuminate\Support\Facades\Route;

Route::post('/create/users/using/command/bus', CreateUserController::class)->name('create.users.by.command-bus');
