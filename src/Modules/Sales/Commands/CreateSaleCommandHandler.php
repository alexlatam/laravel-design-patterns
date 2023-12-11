<?php

namespace Modules\Sales\Commands;

use App\Bus\CommandHandler;
use Modules\Sales\Repositories\Contracts\WriteSaleRepositoryInterface;
use Modules\Sales\ValueObjects\Price;
use Modules\Sales\ValueObjects\SaleId;
use Modules\Sales\ValueObjects\UserId;

/**
 * El Command Handler es el encargado de ejecutar la lógica de negocio de la consulta.
 * En este caso, el Command Handler se encarga de crear una venta.
 * Tambien puede ejecutar el caso de uso [Application Service]. en este caso, el caso de uso es muy simple, por lo que no es necesario.
 * El command Handler mapea los datos del Command a value objects del dominio.
 *
 * Y se los pasa al Use Case. En este caso no hay Use Case. Solo un repositorio.
 * Este Command Handler iria dentro de la capa de Application. En caso de Hexagonal Architecture.
 */
final class CreateSaleCommandHandler extends CommandHandler
{
    // Inyectamos el repositorio que se encargara de crear la venta
    public function __construct(
        protected WriteSaleRepositoryInterface $repository
    ) {
    }

    // Handle es el metodo que se encarga de ejecutar la lógica de negocio del command
    public function handle(CreateSaleCommand $command): void
    {
        $this->repository->create(
            id: new SaleId($command->getId()),
            user_id: new UserId($command->getUserId()),
            price: new Price($command->getPrice()),
        );
    }
}
