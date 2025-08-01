<?php

declare(strict_types=1);

namespace Transactions\OnCommandBus\Shared\Infrastructure\Buses;

use Transactions\OnCommandBus\Shared\Application\Buses\Command;
use Transactions\OnCommandBus\Shared\Application\Buses\CommandBusInterface;
use Transactions\OnCommandBus\Shared\Application\Buses\CommandHandlerInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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

        try {
            if ($command->requiresTransaction()) {
                DB::transaction(function () use ($handler, $command) {
                    $handler->handle($command);
                });
            } else {
                $handler->handle($command);
            }
        } catch (QueryException $e) {
            $this->logger->error('Database error during command execution', [
                'command' => $commandType,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to execute command due to database error.', 0, $e);
        } catch (\Throwable $e) {
            $this->logger->error('Unexpected error during command execution', [
                'command' => $commandType,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to execute command due to unexpected error.', 0, $e);
        }
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
