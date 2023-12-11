<?php

namespace App\Bus\Contracts;

use App\Bus\Query;

/**
 * Interfaz que deben implementar todos los Query Bus.
 * Esta interfaz define el contrato que deben cumplir todos los Query Bus.
 */
interface QueryBusInterface
{
    public function ask(Query $query): mixed;

    public function register(array $map): void;
}
