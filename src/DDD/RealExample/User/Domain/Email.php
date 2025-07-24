<?php

namespace DDD\RealExample\User\Domain;

use InvalidArgumentException;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email format invalid");
        }
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}
