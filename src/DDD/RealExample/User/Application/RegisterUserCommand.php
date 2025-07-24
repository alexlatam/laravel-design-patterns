<?php

namespace DDD\RealExample\User\Application;

use DDD\RealExample\User\Domain\Command;

class RegisterUserCommand extends Command
{
    public function __construct(
        private readonly string $id,
        private readonly string $email,
        private readonly string $password
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
