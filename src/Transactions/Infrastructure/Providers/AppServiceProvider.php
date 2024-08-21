<?php

namespace Transactions\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Transactions\Application\StoreUserUseCase;
use Transactions\Application\StoreUserUseCaseWithRepositoryDecorator;
use Transactions\Domain\IUserRepository;
use Transactions\Infrastructure\Repositories\EloquentMysqlUserRepositoryWithTransaction;
use Transactions\Infrastructure\Repositories\TransactionalEloquentMysqlUserRepositoryDecorator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Transaction en el repositorio
        $this->app->when(StoreUserUseCase::class)
            ->needs(IUserRepository::class)
            ->give(EloquentMysqlUserRepositoryWithTransaction::class);

        // Transaction en el repositorio decorado
        $this->app->when(StoreUserUseCaseWithRepositoryDecorator::class)
            ->needs(IUserRepository::class)
            ->give(TransactionalEloquentMysqlUserRepositoryDecorator::class);
    }

    public function boot(): void
    {
    }
}
