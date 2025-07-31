<?php

namespace DDD\CommandHandlerWithCommandBus\Shared\Application\Buses;

interface CommandBusInterface
{
    /**
     * Dispatch a command to the appropriate command handler.
     *
     * @param Command $command The command to be dispatched.
     */
    public function dispatch(Command $command): void;

    /**
     * Register a command handler for a specific command type.
     *
     * @param string $commandType The fully qualified class name of the command.
     * @param CommandHandlerInterface $handler The command handler to register.
     */
    public function registerHandler(string $commandType, CommandHandlerInterface $handler): void;
}
