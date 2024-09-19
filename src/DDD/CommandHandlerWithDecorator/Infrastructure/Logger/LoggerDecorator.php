<?php

namespace DDD\CommandHandlerWithDecorator\Infrastructure\Logger;

use DDD\CommandHandlerWithDecorator\Application\CreatePostReviewCommand;
use DDD\CommandHandlerWithDecorator\Application\StorePostReviewCommandHandler;
use Monolog\Level;
use Monolog\Logger;

class LoggerDecorator
{
    public function __construct(
        private readonly StorePostReviewCommandHandler $commandHandler,
        private readonly Logger $logger
    )
    {
    }

    public function handle(CreatePostReviewCommand $command): void
    {
        $this->logger->log(Level::Info, $command->getUserId() . ": " . $command->getTitle());
        $this->commandHandler->handle($command);
    }
}
