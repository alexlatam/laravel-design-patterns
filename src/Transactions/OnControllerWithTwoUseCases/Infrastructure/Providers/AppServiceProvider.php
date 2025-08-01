<?php

namespace Transactions\OnControllerWithTwoUseCases\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Transactions\OnControllerWithTwoUseCases\Application\StoreUserUseCase;
use Transactions\OnControllerWithTwoUseCases\Domain\IUserRepository;
use Transactions\OnControllerWithTwoUseCases\Infrastructure\Repositories\EloquentMysqlUserRepository;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(StoreUserUseCase::class)->needs(IUserRepository::class)->give(EloquentMysqlUserRepository::class);
    }
}
