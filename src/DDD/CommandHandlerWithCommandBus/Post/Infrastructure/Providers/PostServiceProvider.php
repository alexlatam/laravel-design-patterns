<?php

namespace DDD\CommandHandlerWithCommandBus\Post\Infrastructure\Providers;

use DDD\CommandHandlerWithCommandBus\Post\Application\StorePostCommandHandler;
use DDD\CommandHandlerWithCommandBus\Post\Domain\PostRepository;
use DDD\CommandHandlerWithCommandBus\Post\Infrastructure\Repositories\EloquentMysqlPostRepository;
use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\CommandBusInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class PostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(StorePostCommandHandler::class)->needs(PostRepository::class)->give(EloquentMysqlPostRepository::class);
    }

    public function boot(CommandBusInterface $commandBus): void
    {
        // Aqui es necesario registrar el comando con su respectivo handler en el CommandBus
        $commandBus->registerHandler(
            commandType: 'DDD\CommandHandlerWithCommandBus\Post\Application\CreatePostCommand',
            handler: App::make(StorePostCommandHandler::class)
        );
    }
}



