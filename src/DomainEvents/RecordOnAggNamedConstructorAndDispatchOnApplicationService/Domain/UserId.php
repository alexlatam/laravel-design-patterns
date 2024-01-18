<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain;

final readonly class UserId
{
    public function __construct(private string $value) {}

    public function value(): string
    {
        return $this->value;
    }
}
