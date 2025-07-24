<?php

namespace Hex\Shared;

class User
{
    private function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password
    ) {
    }

    public static function create(
        string $id,
        string $name,
        string $email,
        string $password
    ): self {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return new self($id, $name, $email, $password);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
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
