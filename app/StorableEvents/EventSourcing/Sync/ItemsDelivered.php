<?php

namespace App\StorableEvents\EventSourcing\Sync;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ItemsDelivered extends ShouldBeStored
{
    public function __construct(
        public string $citizenUuid,
        public int $amount,
    ) {
    }
}
