<?php

namespace Transactions\OnRepositoryWithDecorator\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Transactions\OnRepositoryWithDecorator\Application\StoreUserUseCase;
use Transactions\OnRepositoryWithDecorator\Domain\IUserRepository;
use Transactions\OnRepositoryWithDecorator\Infrastructure\Repositories\TransactionalEloquentMysqlUserRepositoryDecorator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Transaction en el repositorio decorado
        $this->app->when(StoreUserUseCase::class)
            ->needs(IUserRepository::class)
            ->give(TransactionalEloquentMysqlUserRepositoryDecorator::class);
    }

    public function boot(): void
    {
    }
}
