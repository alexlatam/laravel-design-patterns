<?php

namespace App\StorableEvents\EventSourcing;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TransactionCountCreated extends ShouldBeStored
{
    public function __construct(
        public string $uuid,
        public array $attributes,
    ) {
    }
}
