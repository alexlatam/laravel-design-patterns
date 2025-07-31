<?php

namespace DDD\CommandHandlerWithCommandBus\Shared\Infrastructure\Providers;

use DDD\CommandHandlerWithCommandBus\Post\Infrastructure\Providers\PostServiceProvider;
use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\CommandBusInterface;
use DDD\CommandHandlerWithCommandBus\Shared\Infrastructure\Buses\SyncInMemoryCommandBus;
use Illuminate\Support\ServiceProvider;

class CommandHandlerWithCommandBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            CommandBusInterface::class,
            SyncInMemoryCommandBus::class
        );

        $this->app->register(PostServiceProvider::class);
    }
}



