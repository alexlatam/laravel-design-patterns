<?php

namespace Modules\Sales\Repositories\Contracts;

use Modules\Sales\ValueObjects\Price;
use Modules\Sales\ValueObjects\SaleId;
use Modules\Sales\ValueObjects\UserId;

/**
 * Interfaz que define el contrato que debe cumplir un repositorio de escritura de ventas.
 *
 * Este Contrato iria dentro de la capa de Domain. En caso de Hexagonal Architecture.
 */
interface WriteSaleRepositoryInterface
{
    public function create(SaleId $id, UserId $user_id, Price $price): string;
}
