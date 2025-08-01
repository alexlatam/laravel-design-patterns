<?php

namespace Transactions\OnCommandBus\Post\Infrastructure\Providers;

use Transactions\OnCommandBus\Post\Application\StorePostCommandHandler;
use Transactions\OnCommandBus\Post\Domain\PostRepository;
use Transactions\OnCommandBus\Post\Infrastructure\Repositories\EloquentMysqlPostRepository;
use Transactions\OnCommandBus\Shared\Application\Buses\CommandBusInterface;
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



