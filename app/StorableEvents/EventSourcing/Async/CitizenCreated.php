<?php

namespace App\StorableEvents\EventSourcing\Async;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CitizenCreated extends ShouldBeStored
{
    public function __construct(
        public string $userId,
    ) {
    }
}
