<?php

namespace Transactions\OnCommandBus\Shared\Application\Buses;

abstract class Command
{
    // NOTE: this has structural coupling
    public function requiresTransaction(): bool
    {
        return true; // Default to make transactional every command
    }
}
