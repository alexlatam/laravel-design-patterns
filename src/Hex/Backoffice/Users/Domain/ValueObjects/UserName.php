<?php

namespace Hex\Backoffice\Users\Domain\ValueObjects;

use Hex\Backoffice\Users\Domain\Exceptions\UserNameIsEmptyException;

final readonly class UserName
{
    /**
     * @throws UserNameIsEmptyException
     */
    public function __construct(private string $value)
    {
        $this->isNotEmpty();
    }

    public function getName(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws UserNameIsEmptyException
     */
    private function isNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new UserNameIsEmptyException();
        }
    }

}
