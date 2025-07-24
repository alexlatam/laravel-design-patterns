<?php

namespace DDD\CommandHandlerWithDecorator\Domain;

readonly class UserId
{
    public function __construct(private string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
