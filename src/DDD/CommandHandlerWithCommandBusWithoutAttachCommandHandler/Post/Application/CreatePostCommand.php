<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Application;

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\Command;

final class CreatePostCommand extends Command
{
    public function __construct(
        public readonly string  $userId,
        public readonly string  $postId,
        public readonly string  $title,
        public readonly string $content
    ) {
    }
}
