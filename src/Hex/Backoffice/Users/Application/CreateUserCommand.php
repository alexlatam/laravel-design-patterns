<?php

namespace Hex\Backoffice\Users\Application;

use Hex\Backoffice\Users\Domain\Command;

final class CreateUserCommand extends Command
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
        private readonly string $created_at,
        private readonly string $updated_at,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
