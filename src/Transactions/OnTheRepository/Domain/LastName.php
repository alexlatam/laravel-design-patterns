<?php

namespace Transactions\OnTheRepository\Domain;

final readonly class LastName
{
    public function __construct(public string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('First name cannot be empty.');
        }

        if (strlen($value) < 2 || strlen($value) > 50) {
            throw new \InvalidArgumentException('First name must be between 2 and 50 characters long.');
        }

        if (!preg_match('/^[a-zA-Z]+$/', $value)) {
            throw new \InvalidArgumentException('First name can only contain letters.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
