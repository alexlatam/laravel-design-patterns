<?php

namespace Transactions\OnTheRepository\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Transactions\OnTheRepository\Application\StoreUserUseCase;
use Transactions\OnTheRepository\Domain\UserRepository;

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
