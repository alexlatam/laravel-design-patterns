<?php

namespace DDD\CommandHandlerWithDecorator\Infrastructure\Logger;

use DDD\CommandHandlerWithDecorator\Application\CreatePostReviewCommand;
use DDD\CommandHandlerWithDecorator\Application\StorePostReviewCommandHandler;
use Monolog\Level;
use Monolog\Logger;

/**
 * Este decorator decora al Command Handler principal. Osea el Command Handler que ejecuta la accion principal.
 * En este caso el Command Handler principal es StorePostReviewCommandHandler y este decorator es LoggerDecorator.
 * El objectivo de esta clase es loggear la accion que se esta ejecutando, antes de ejecutarse.
 */
readonly class LoggerDecorator
{
    public function __construct(
        private StorePostReviewCommandHandler $commandHandler,
        private Logger                        $logger
    ) {
    }

    public function handle(CreatePostReviewCommand $command): void
    {
        $this->logger->log(Level::Info, $command->getUserId() . ": " . $command->getTitle());
        $this->commandHandler->handle($command);
    }
}
