<?php

namespace Cache\Infrastructure\Providers;

use Cache\Application\GetUsersWithCacheDecoratorOnRepositoryUseCase;
use Cache\Application\GetUsersWithCacheOnRepositoryUseCase;
use Cache\Application\GetUsersWithCacheOnThisUseCase;
use Cache\Domain\IUserRepository;
use Cache\Infrastructure\Cache\ICache;
use Cache\Domain\ICache as ICacheDomain;
use Cache\Infrastructure\Cache\MemoryCache;
use Cache\Infrastructure\Cache\MemoryCacheRepositoryDecorator;
use Cache\Infrastructure\Repositories\UserRepository;
use Cache\Infrastructure\Repositories\UserRepositoryWithCache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Cache en el caso de uso
        $this->app->when(GetUsersWithCacheOnThisUseCase::class)
            ->needs(IUserRepository::class)
            ->give(UserRepository::class);
        $this->app->when(GetUsersWithCacheOnThisUseCase::class)
            ->needs(ICacheDomain::class)
            ->give(MemoryCache::class);

        // Cache en el repositorio. El repositorio es el encargado de la cache
        $this->app->when(GetUsersWithCacheOnRepositoryUseCase::class)
            ->needs(IUserRepository::class)
            ->give(UserRepositoryWithCache::class);

        // Decorador de Repositorio con Cache
        $this->app->when(GetUsersWithCacheDecoratorOnRepositoryUseCase::class)
            ->needs(IUserRepository::class)
            ->give(MemoryCacheRepositoryDecorator::class);
    }

    public function boot(): void
    {
    }
}
