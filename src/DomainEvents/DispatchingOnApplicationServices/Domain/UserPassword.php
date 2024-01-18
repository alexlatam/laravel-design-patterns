<?php

namespace DomainEvents\DispatchingOnApplicationServices\Domain;

use InvalidArgumentException;

final readonly class UserPassword
{
    public function __construct(private string $value) {
        if (!$this->isValid()) {
            throw new InvalidArgumentException("Invalid password");
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    // validate correct format of password
    public function isValid(): bool
    {
        return strlen($this->value) >= 8;
    }
}
