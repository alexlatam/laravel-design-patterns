<?php

namespace Modules\Sales\Queries;

use App\Bus\Query;

/**
 * Este es el query que se encarga de buscar una venta por su id.
 * No es mas que un simple DTO.
 * Que contiene lo necesario para ejecutar la consulta. Para obtener la venta por su id.
 *
 * Los Command son inmutables. Y ademas reciben todos sus datos en el constructor. Solo primitivos. Nade de objetos.
 * Este Query iria dentro de la capa de Application. En caso de Hexagonal Architecture.
 */
final class FindSaleQuery extends Query
{
    public function __construct(private readonly string $id)
    {}

    public function getId(): string
    {
        return $this->id;
    }
}
