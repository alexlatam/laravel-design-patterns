<?php

namespace DDD\RealExample\User\Infrastructure\Providers;

use DDD\RealExample\User\Domain\UserRepository;
use DDD\RealExample\User\Infrastructure\Persistence\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }

    public function boot()
    {
        //
    }
}
