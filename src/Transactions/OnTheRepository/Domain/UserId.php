<?php

namespace Transactions\OnTheRepository\Domain;

use InvalidArgumentException;

final readonly class UserId
{
    public function __construct(public string $value)
    {
        // validate ths id is not empty
        if (empty($value)) {
            throw new InvalidArgumentException('User ID cannot be empty.');
        }

        // validate that the id is a valid UUID
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $value)) {
            throw new InvalidArgumentException('Invalid User ID format.');
        }
    }

    public function isEquals(self $otherId): bool
    {
        return $this->value === $otherId->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
