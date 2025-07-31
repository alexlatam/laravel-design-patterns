<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Infrastructure\Buses;

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\Command;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\CommandBusInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\App;

class SyncInMemoryCommandBusWithoutAttachCommandHandler implements CommandBusInterface
{
    private array $handlers = [];

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function dispatch(Command $command): void
    {
        $handlerClass = $this->resolveHandler($command);
        $handler = App::make($handlerClass);
        $handler->handle($command);
    }

    /**
     * @throws Exception
     */
    private function resolveHandler(Command $command): string
    {
        $commandClass = get_class($command);
        // Esto implica que el nombre de las calses sigue la convención: nombre de la clase del comando termina con "Command" y el manejador termina con "CommandHandler".
        // Adicionalmente ambos archivos deben estar en el mismo namespace.
        $handlerClass = preg_replace('/Command$/', 'CommandHandler', $commandClass);

        if (!class_exists($handlerClass)) {
            throw new Exception("Command handler not found for {$commandClass}");
        }

        return $handlerClass;
    }
}
