<?php

namespace Hex\Users\Domain\ValueObjects;

use Hex\Users\Domain\Exceptions\UserEmailIsEmptyException;

final readonly class UserEmail
{
    /**
     * @throws UserEmailIsEmptyException
     */
    public function __construct(private string $value)
    {
        $this->isNotEmpty();
    }

    /**
     * @throws UserEmailIsEmptyException
     */
    private function isNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new UserEmailIsEmptyException();
        }
    }

    public function getEmail(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
