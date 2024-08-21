<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts;

class UuidGenerator
{
    public static function generate(): string {
        return uniqid();
    }

    public function isValid(): bool
    {
        return true;
    }
}
