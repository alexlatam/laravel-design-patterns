<?php

namespace CQRS\Products\Infrastructure\Buses;

use CQRS\Shared\Domain\Bus\Queries\Query;
use CQRS\Shared\Domain\Bus\Queries\QueryBusInterface;
use Illuminate\Bus\Dispatcher;

/**
 * Implementacion concreta de QueryBusInterface usando el Dispatcher de Illuminate Bus.
 * Esta implementacion es un Query Bus Sincrono.
 * Esta clase no es mas que un simple wrapper del Dispatcher de Illuminate Bus.
 */
final class IlluminateQueryBus implements QueryBusInterface
{
    public function __construct(
        protected Dispatcher $dispatcher,
    ) {}

    /**
     * Este metodo es el encargado de despachar[dispatch] el Query hacia el Query Handler.
     */
    public function ask(Query $query): mixed
    {
        return $this->dispatcher->dispatch($query);
    }

    /**
     * Este metodo es el encargado de registrar los Query Handlers.
     * Cada Query Handler debe ser registrado en el Dispatcher de Illuminate Bus.
     * Este metodo nos perimitira registrar cada Query con su respectivo Query Handler.
     * -- Importante: Cada Query debe tener un solo Query Handler.
     */
    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
