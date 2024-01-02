<?php

namespace Hex\Users\Domain\ValueObjects;

final readonly class UserUpdatedAt
{
    public function __construct(private string $value)
    {
        $this->isNotEmpty();
    }

    private function isNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new UserUpdatedAtIsEmptyException();
        }
    }

    public function getUpdatedAt(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
