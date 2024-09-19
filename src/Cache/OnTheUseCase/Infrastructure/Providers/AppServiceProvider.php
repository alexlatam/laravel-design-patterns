<?php

namespace Cache\OnTheUseCase\Infrastructure\Providers;

use Cache\OnTheUseCase\Domain\ICache as ICacheDomain;
use Cache\OnTheUseCase\Domain\IUserRepository;
use Cache\OnTheUseCase\Infrastructure\Cache\MemoryCache;
use Cache\OnTheUseCase\Application\GetUsersWithCacheOnThisUseCase;
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
    }

    public function boot(): void
    {
    }
}
