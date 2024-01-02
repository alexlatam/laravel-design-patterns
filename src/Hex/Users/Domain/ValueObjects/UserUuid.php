<?php

namespace Hex\Users\Domain\ValueObjects;

use Hex\Users\Domain\Exceptions\UserUuidIsEmptyException;

final readonly class UserUuid
{
    /**
     * @throws UserUuidIsEmptyException
     */
    public function __construct(private string $value)
    {
        $this->isNotEmpty();
    }

    /**
     * @throws UserUuidIsEmptyException
     */
    private function isNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new UserUuidIsEmptyException();
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
