<?php

namespace Transactions\OnController\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Transactions\OnController\Application\StoreUserUseCase;
use Transactions\OnController\Domain\UserRepository;

// This provider must be registered in the config/app.php file under 'providers' array
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(StoreUserUseCase::class)
            ->needs(UserRepository::class)
            ->give(EloquentMySQLUserRepository::class);
    }
}
