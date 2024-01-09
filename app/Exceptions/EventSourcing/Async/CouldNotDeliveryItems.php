<?php

namespace App\Exceptions\EventSourcing\Async;

use Exception;

class CouldNotDeliveryItems extends Exception
{
    public static function limitExceeded(int $amount): self
    {
        return new static("Could not delivery {$amount} items because the limit of 100 was exceeded.");
    }
}
