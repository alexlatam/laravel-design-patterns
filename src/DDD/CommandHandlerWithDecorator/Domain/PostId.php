<?php

namespace DDD\CommandHandlerWithDecorator\Domain;

readonly class PostId
{
    public function __construct(private string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
