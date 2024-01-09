<?php

namespace App\StorableEvents\EventSourcing\Async;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ItemsDelivered extends ShouldBeStored
{
    public function __construct(
        public int $amount
    ) {
    }
}
