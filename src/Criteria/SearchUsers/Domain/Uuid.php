<?php

namespace Criteria\SearchUsers\Domain;

class Uuid
{
    public function __construct(private readonly string $value)
    {
        if (!\preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $value)) {
            throw new \InvalidArgumentException('Invalid UUID format');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $id): bool
    {
        return $this->value === $id->value();
    }
}
