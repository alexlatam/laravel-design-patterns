<?php

namespace App\Services;

use Ramsey\Uuid\Uuid;

class UuidService
{
    public function generateId(): string
    {
        return Uuid::uuid4()->toString();
    }
}
