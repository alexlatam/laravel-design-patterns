<?php

namespace CQRS\Shared\Domain\Bus\Commands;

/**
 * Interfaz que deben implementar todos los Command Bus.
 * Esta interfaz define el contrato que deben cumplir todos los Command Bus.
 */
interface CommandBusInterface
{
    // Método que se encarga de despachar un comando.
    public function dispatch(Command $command): mixed;

    // Método que se encarga de registrar un comando.
    public function register(array $map): void;
}
