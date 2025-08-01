<?php

namespace Transactions\OnCommandBus\Post\Domain;

class UuidValueObject
{
    public function __construct(private readonly string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
