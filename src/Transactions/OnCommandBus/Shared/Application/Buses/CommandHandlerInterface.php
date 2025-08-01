<?php

namespace Transactions\OnCommandBus\Shared\Application\Buses;

interface CommandHandlerInterface
{
    public function handle(Command $command): void;
}
