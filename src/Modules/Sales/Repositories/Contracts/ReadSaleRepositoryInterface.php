<?php

namespace Modules\Sales\Repositories\Contracts;

use Modules\Sales\ValueObjects\SaleId;

/**
 * Interfaz que define el contrato que debe cumplir un repositorio de lectura de ventas.
 *
 * Este Contrato iria dentro de la capa de Domain. En caso de Hexagonal Architecture.
 */
interface ReadSaleRepositoryInterface
{
    public function find(SaleId $id): ?object;
}
