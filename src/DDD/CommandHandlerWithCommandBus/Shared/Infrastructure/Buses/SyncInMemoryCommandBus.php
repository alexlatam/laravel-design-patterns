<?php

declare(strict_types=1);

namespace DDD\CommandHandlerWithCommandBus\Shared\Infrastructure\Buses;

use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\Command;
use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\CommandBusInterface;
use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\CommandHandlerInterface;

class SyncInMemoryCommandBus implements CommandBusInterface
{
    private array $handlers = [];

    public function dispatch(Command $command): void
    {
        $commandType = get_class($command);

        if (!isset($this->handlers[$commandType])) {
            throw new \RuntimeException(sprintf(
                'No handler registered for command type "%s".',
                $commandType
            ));
        }

        $handler = $this->handlers[$commandType];
        $handler->handle($command);
    }

    /**
     * this method registers a command handler for a specific command type.
     * This method will be called on the application bootstrap [On The Service Provider]
     */
    public function registerHandler(string $commandType, CommandHandlerInterface $handler): void
    {
        if (!is_subclass_of($commandType, Command::class)) {
            throw new \InvalidArgumentException(sprintf(
                'Command type "%s" must be a subclass of "%s".',
                $commandType,
                Command::class
            ));
        }

        if (isset($this->handlers[$commandType])) {
            throw new \InvalidArgumentException(sprintf(
                'Handler for command type "%s" is already registered.',
                $commandType
            ));
        }

        $this->handlers[$commandType] = $handler;
    }
}
