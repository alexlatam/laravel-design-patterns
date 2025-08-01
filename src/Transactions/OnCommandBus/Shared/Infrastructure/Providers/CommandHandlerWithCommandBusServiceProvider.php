<?php

namespace Transactions\OnCommandBus\Shared\Infrastructure\Providers;

use Transactions\OnCommandBus\Post\Infrastructure\Providers\PostServiceProvider;
use Transactions\OnCommandBus\Shared\Application\Buses\CommandBusInterface;
use Transactions\OnCommandBus\Shared\Infrastructure\Buses\SyncInMemoryCommandBus;
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



