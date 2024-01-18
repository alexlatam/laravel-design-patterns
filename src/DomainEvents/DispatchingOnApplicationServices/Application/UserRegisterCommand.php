<?php

namespace DomainEvents\DispatchingOnApplicationServices\Application;

final readonly class UserRegisterCommand
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
    ) {}

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
