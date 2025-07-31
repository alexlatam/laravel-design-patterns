<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
