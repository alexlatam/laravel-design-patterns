<?php

namespace Hex\Users\Infrastructure\Buses;

use Hex\Users\Domain\Command;
use Hex\Users\Domain\CommandBusInterface;
use Illuminate\Bus\Dispatcher;

final class IlluminateCommandBus implements CommandBusInterface
{
    /**
     * Inyectamos el Dispatcher de Illuminate Bus.
     * Este es el encargado de ejecutar el Command Handler.
     */
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
