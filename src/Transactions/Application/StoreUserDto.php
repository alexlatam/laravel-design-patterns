<?php

namespace Transactions\Application;

final readonly class StoreUserDto
{
    public function __construct(
        private string $id,
        private string $firstname,
        private string $lastname,
        private string $email
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
