<?php

namespace App\StorableEvents\EventSourcing\Sync;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CitizenCreated extends ShouldBeStored
{
    public function __construct(
        public string $uuid,
        public array $attributes,
    ) {
    }
}
