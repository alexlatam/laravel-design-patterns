<?php

namespace DomainEvents\DispatchingOnApplicationServices\Domain;

use InvalidArgumentException;

readonly class UserEmail
{
    public function __construct(private string $value) {
        if (!$this->isValid()) {
            throw new InvalidArgumentException("Invalid email");
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

    // validate correct format of email
    public function isValid(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
