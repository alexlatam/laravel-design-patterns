<?php

namespace Hex\Backoffice\Users\Domain\ValueObjects;

use Hex\Backoffice\Users\Domain\Exceptions\UserPasswordIsEmptyException;

final readonly class UserPassword
{
    /**
     * @throws UserPasswordIsEmptyException
     */
    public function __construct(private string $value)
    {
        $this->isNotEmpty();
    }

    /**
     * @throws UserPasswordIsEmptyException
     */
    private function isNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new UserPasswordIsEmptyException();
        }
    }

    public function getPassword(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
