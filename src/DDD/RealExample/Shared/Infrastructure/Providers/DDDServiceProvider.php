<?php

namespace DDD\RealExample\Shared\Infrastructure\Providers;

use DDD\RealExample\Shared\Domain\EventDispatcherInterface;
use DDD\RealExample\Shared\Infrastructure\Event\LaravelEventDispatcher;
use DDD\RealExample\User\Infrastructure\Providers\UserServiceProvider;
use Illuminate\Support\ServiceProvider;

class DDDServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->bind(EventDispatcherInterface::class, function ($app) {
            return new LaravelEventDispatcher($app['events']);
        });
    }
}



