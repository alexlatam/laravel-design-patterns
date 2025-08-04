<?php

namespace CQRS\Shared\Domain;

use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    public static function generate(): string {
        return Uuid::uuid4()->toString();
    }

    public static function isValid(string $possibleUuid): bool
    {
        return Uuid::isValid($possibleUuid);
    }
}
