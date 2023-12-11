<?php

namespace Modules\Sales\Commands;

use App\Bus\Command;

/**
 * Este es el command que se encarga de crear una venta
 * No es mas que un simple DTO.
 * Que contiene lo necesario para ejecutar la consulta. Para crear una venta.
 *
 * Los Command son inmutables. Y ademas reciben todos sus datos en el constructor. Solo primitivos. Nade de objetos.
 * Este Command iria dentro de la capa de Application. En caso de Hexagonal Architecture.
 */
final class CreateSaleCommand extends Command
{
    public function __construct(
        private readonly string $id,
        private readonly string $user_id,
        private readonly int $price,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }
}
