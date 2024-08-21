<?php

namespace CQRS\Products\Application\Find;

use CQRS\Products\Domain\Product;
use CQRS\Shared\Domain\Bus\Queries\QueryBusInterface;

readonly class FindProductUseCase
{
    public function __construct(
        protected QueryBusInterface $queryBus,
    ) {}

    public function execute(FindProductQuery $query): Product
    {
        /**
         * Creamos el Query. El Query es un DTO. Que contiene los datos necesarios para obtener una venta.
         * Despachamos el Query al QueryBus.
         * El QueryBus se encargara de ejecutar el Query Handler. AppServiceProvider
         */
        $query = new FindProductQuery($query->getId());
        return $this->queryBus->ask($query);
    }
}
