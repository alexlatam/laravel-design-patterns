<?php

namespace App\CommandHandlers;

/**
 * Decorador que se encarga de loggear los comandos antes que se ejecuten en el command handler
 */
class LoggerDecorator implements CommandHandlerInterface
{
    /**
     * Estas dependencias se inyectan automáticamente por Laravel
     */
    public function __construct(
        private PublishArticleCommandHandler $commandHandler,
        private                              $logger
    )
    {
    }

    public function execute(PublishArticleCommand $command)
    {
        $this->logger->info("Executing command: " . get_class($command));
        $this->commandHandler->execute($command);
    }
}
