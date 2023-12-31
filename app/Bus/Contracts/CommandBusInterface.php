<?php

namespace App\Bus\Contracts;

use App\Bus\Command;

/**
 * Interfaz que deben implementar todos los Command Bus.
 * Esta interfaz define el contrato que deben cumplir todos los Command Bus.
 */
interface CommandBusInterface
{
    public function dispatch(Command $command): mixed;

    public function register(array $map): void;
}
