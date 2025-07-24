<?php

namespace DDD\RealExample\User\Domain;

use InvalidArgumentException;

class Password
{
    private string $password;
    private const MIN_LENGTH = 8;

    public function __construct(string $password)
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new InvalidArgumentException("The password must be at least 8 characters long");
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function value(): string
    {
        return $this->password;
    }
}
