<?php

namespace Transactions\OnTheRepository\Domain;

use InvalidArgumentException;

final readonly class Email
{
    public function __construct(public string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Email cannot be empty.');
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email format.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
