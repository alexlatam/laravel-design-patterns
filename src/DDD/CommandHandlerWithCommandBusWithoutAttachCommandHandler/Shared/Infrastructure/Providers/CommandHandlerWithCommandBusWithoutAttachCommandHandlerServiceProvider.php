<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Infrastructure\Providers;

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Infrastructure\Providers\PostServiceProvider;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\CommandBusInterface;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Infrastructure\Buses\SyncInMemoryCommandBusWithoutAttachCommandHandler;
use Illuminate\Support\ServiceProvider;

class CommandHandlerWithCommandBusWithoutAttachCommandHandlerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            CommandBusInterface::class,
            SyncInMemoryCommandBusWithoutAttachCommandHandler::class
        );

        $this->app->register(PostServiceProvider::class);
    }
}



