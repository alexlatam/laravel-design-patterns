<?php

namespace CQRS\Products\Application\Find;

use CQRS\Products\Domain\Exceptions\ProductNotFound;
use CQRS\Products\Domain\Repositories\ProductRepositoryInterface;
use CQRS\Products\Domain\ValueObjects\ProductId;
use CQRS\Shared\Domain\Bus\Queries\QueryHandler;

/**
 * El Query Handler es el encargado de ejecutar la lógica de negocio de la consulta.
 * En este caso, el Query Handler se encarga de buscar una venta por su id.
 *
 * Tambien puede ejecutar el caso de uso [Application Service]. en este caso, el caso de uso es muy simple, por lo que no es necesario.
 * Este Query Handler iria dentro de la capa de Application. En caso de Hexagonal Architecture.
 */
final class FindProductQueryHandler extends QueryHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $repository
    ) {
    }

    /**
     * @throws ProductNotFound
     */
    public function handle(FindProductQuery $query): ?object
    {
        $product = $this->repository->find(new ProductId($query->getId()));

        if (is_null($product)) {
            throw new ProductNotFound($query->getId());
        }

        return $product;
    }
}
