<?php

namespace CQRS\Shared\Infrastructure\Buses;

use CQRS\Shared\Domain\Bus\Commands\Command;
use CQRS\Shared\Domain\Bus\Commands\CommandBusInterface;
use Illuminate\Bus\Dispatcher as IlluminateCommandDispatcher;

final class IlluminateCommandBus implements CommandBusInterface
{
    /**
     * Inyectamos el Dispatcher de Illuminate Bus.
     * Este es el encargado de ejecutar el Command Handler.
     */
    public function __construct(
        protected IlluminateCommandDispatcher $dispatcher,
    ) {}

    public function dispatch(Command $command): void
    {
        $this->dispatcher->dispatch($command);
    }

    public function register(string $command, string $handler): void
    {
        // [CreateProductCommand::class => CreateProductCommandHandler::class]
        $this->dispatcher->map([$command => $handler]);
    }
}
