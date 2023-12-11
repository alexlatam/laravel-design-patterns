<?php

namespace Modules\Sales\Queries;

use App\Bus\QueryHandler;
use Modules\Sales\Repositories\Contracts\ReadSaleRepositoryInterface;
use Modules\Sales\ValueObjects\SaleId;

/**
 * El Query Handler es el encargado de ejecutar la lógica de negocio de la consulta.
 * En este caso, el Query Handler se encarga de buscar una venta por su id.
 *
 * Tambien puede ejecutar el caso de uso [Application Service]. en este caso, el caso de uso es muy simple, por lo que no es necesario.
 * Este Query Handler iria dentro de la capa de Application. En caso de Hexagonal Architecture.
 */
final class FindSaleQueryHandler extends QueryHandler
{
    public function __construct(
        private readonly ReadSaleRepositoryInterface $repository
    ) {
    }

    public function handle(FindSaleQuery $query): ?object
    {
        return $this->repository->find(
            new SaleId($query->getId())
        );
    }
}
