<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Infrastructure\Providers;

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Application\CreatePostCommandHandler;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Domain\PostRepository;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Infrastructure\Repositories\EloquentMysqlPostRepository;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(CreatePostCommandHandler::class)->needs(PostRepository::class)->give(EloquentMysqlPostRepository::class);
    }
}



