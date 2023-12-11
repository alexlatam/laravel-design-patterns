<?php

namespace App\Bus;

use App\Bus\Contracts\CommandBusInterface;
use Illuminate\Bus\Dispatcher;

/**
 * Implementacion concreta de CommandBusInterface usando el Dispatcher de Illuminate Bus.
 * Esta implementacion es un Command Bus Sincrono.
 * Esta clase no es mas que un simple wrapper del Dispatcher de Illuminate Bus.
 */
final class IlluminateCommandBus implements CommandBusInterface
{
    // Inyectamos el Dispatcher de Illuminate Bus.
    // Este es el encargado de ejecutar el Command Handler.
    public function __construct(
        protected Dispatcher $dispatcher,
    ) {
    }

    public function dispatch(Command $command): mixed
    {
        return $this->dispatcher->dispatch($command);
    }

    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
