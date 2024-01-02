<?php

namespace Hex\Users\Domain\ValueObjects;

use Hex\Users\Domain\Exceptions\UserCreatedAtIsEmptyException;

final readonly class UserCreatedAt
{
    /**
     * @throws UserCreatedAtIsEmptyException
     */
    public function __construct(private string $value)
    {
        $this->isNotEmpty();
    }

    /**
     * @throws UserCreatedAtIsEmptyException
     */
    private function isNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new UserCreatedAtIsEmptyException();
        }
    }

    public function getCreatedAt(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
