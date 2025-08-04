<?php

namespace CQRS\Shared\Domain\Bus\Commands;

/**
 * Clase base a partir de la cual se extienden todos los Command Handlers.
 * Puede tener logica adicional, en este caso no contiene nada.
 */
interface CommandHandler
{
    public function handle(Command $command): void;
}
