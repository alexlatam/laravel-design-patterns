<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses;

interface CommandBusInterface
{
    /**
     * Dispatch a command to the appropriate command handler.
     *
     * @param Command $command The command to be dispatched.
     */
    public function dispatch(Command $command): void;
}
