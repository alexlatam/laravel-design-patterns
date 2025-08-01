<?php

namespace Transactions\OnRepositoryWithDecorator\Domain;

class User
{
    private function __construct(
        private readonly string $id,
        private string          $firstname,
        private string          $lastname,
        private string          $email
    )
    {
    }

    public static function create(
        string $id,
        string $firstname,
        string $lastname,
        string $email
    ): self
    {
        return new self($id, $firstname, $lastname, $email);
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

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
