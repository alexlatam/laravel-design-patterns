<?php

namespace App\StorableEvents\EventSourcing\Async;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CitizenLimitHit extends ShouldBeStored
{
    public function __construct()
    {
    }
}
