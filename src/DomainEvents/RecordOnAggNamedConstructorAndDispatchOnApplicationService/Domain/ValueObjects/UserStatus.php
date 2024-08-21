<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects;

class UserStatus
{
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';
    public const ARCHIVED = 'archived';

    public function __construct(
        private string $status
    ) {
    }

    public function value(): string
    {
        return $this->status;
    }
}
