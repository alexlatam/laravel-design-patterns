<?php

namespace CQRS\Products\Application\Create;

use CQRS\Products\Domain\Product;
use CQRS\Products\Domain\Repositories\ProductRepositoryInterface;
use CQRS\Shared\Domain\Bus\Commands\CommandHandler;

/**
 * El Command Handler es el encargado de ejecutar la lógica de negocio de la consulta.
 * En este caso, el Command Handler se encarga de crear una venta.
 * Tambien puede ejecutar el caso de uso [Application Service]. en este caso, el caso de uso es muy simple, por lo que no es necesario.
 * El command Handler mapea los datos del Command a value objects del dominio.
 *
 * Y se los pasa al Use Case. En este caso no hay Use Case. Solo un repositorio.
 * Este Command Handler iria dentro de la capa de Application. En caso de Hexagonal Architecture.
 */
final class CreateProductCommandHandler extends CommandHandler
{
    // Inyectamos el repositorio que se encargara de crear la venta
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {
    }

    // Handle es el metodo que se encarga de ejecutar la lógica de negocio del command
    public function handle(CreateProductCommand $command): void
    {
        $this->repository->save(Product::create(
            id: $command->getId(),
            title: $command->getTitle(),
            price: $command->getPrice(),
            image: $command->getImage(),
        ));
    }
}
