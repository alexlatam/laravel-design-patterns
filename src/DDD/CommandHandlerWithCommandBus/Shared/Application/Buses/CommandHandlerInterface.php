<?php

namespace DDD\CommandHandlerWithCommandBus\Shared\Application\Buses;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
