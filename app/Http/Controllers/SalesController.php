<?php

namespace App\Http\Controllers;

use App\Bus\Contracts\CommandBusInterface;
use App\Bus\Contracts\QueryBusInterface;
use App\Models\User;
use App\Services\UuidService;
use Illuminate\Http\JsonResponse;
use Modules\Sales\Commands\CreateSaleCommand;
use Modules\Sales\Queries\FindSaleQuery;

/**
 * Este controlador es el encargado de crear una venta.
 * Para esto usaremos el CommandBus y el QueryBus.
 * Usaremos el patron arquitectonico CQRS.
 */
final class SalesController
{
    /**
     * Inyectamos el CommandBus y el QueryBus.
     * El CommandBus se encargara de ejecutar el Command Handler.
     * El QueryBus se encargara de ejecutar el Query Handler.
     */
    public function __construct(
        protected CommandBusInterface $commandBus,
        protected QueryBusInterface $queryBus,
        protected UuidService $uuidService,
    ) {
    }

    /**
     * Los datos de la venta pueden venir de la request. En este caso se validaran mediante un form request.
     * En este ejemplo, los datos los estamos generando fake.
     */
    public function __invoke(): JsonResponse
    {
        /**
         * Este id lo generamos con un servicio. Puede venir directamente de la request[desde el front - cliente].
         * En este caso lo generamos con un servicio.
        */
        $sale_id = $this->uuidService->generateId();

        /**
         * Creamos el command. El command es un DTO. Que contiene los datos necesarios para crear una venta.
         * Despachamos el command al CommandBus.
         * El CommandBus se encargara de ejecutar el Command Handler. Esto esta definido en el AppServiceProvider.
         */
        $command = new CreateSaleCommand(
            id: $sale_id,
            user_id: User::first()->id,
            price: 1000
        );
        $this->commandBus->dispatch($command);

        /**
         * Creamos el Query. El Query es un DTO. Que contiene los datos necesarios para obtener una venta.
         * Despachamos el Query al QueryBus.
         * El QueryBus se encargara de ejecutar el Query Handler. AppServiceProvider
         */
        $query = new FindSaleQuery($sale_id);
        $sale = $this->queryBus->ask($query);

        return response()->json($sale);
    }

}
