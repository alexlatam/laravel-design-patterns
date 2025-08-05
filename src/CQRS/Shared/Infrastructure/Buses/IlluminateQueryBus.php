<?php

namespace CQRS\Shared\Infrastructure\Buses;

use CQRS\Shared\Domain\Bus\Queries\Query;
use CQRS\Shared\Domain\Bus\Queries\QueryBusInterface;
use CQRS\Shared\Domain\Bus\Queries\QueryResponse;
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
    public function ask(Query $query): QueryResponse
    {
        $response = $this->dispatcher->dispatch($query);

        // pasar de una entidad de dominio a un objeto de respuesta
        if ($response instanceof QueryResponse) {
            return $response;
        }

        // Si el Query Handler devuelve un objeto de dominio, lo convertimos a un array
        if (method_exists($response, 'toArray')) {
            return new QueryResponse($response->toArray());
        }

        // Si el Query Handler devuelve un objeto que no tiene el metodo toArray, lo convertimos a un array
        if (is_object($response)) {
            return new QueryResponse((array) $response);
        }

        // Si el Query Handler devuelve un array, lo convertimos a un QueryResponse
        if (is_array($response)) {
            return new QueryResponse($response);
        }

        // Si el Query Handler devuelve un tipo primitivo, lo convertimos a un array
        if (is_scalar($response)) {
            return new QueryResponse(['value' => $response]);
        }

        // Si el Query Handler devuelve un tipo no esperado, lanzamos una excepcion
        throw new \InvalidArgumentException('El Query Handler debe devolver un objeto de dominio, un array o un tipo primitivo.');
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
