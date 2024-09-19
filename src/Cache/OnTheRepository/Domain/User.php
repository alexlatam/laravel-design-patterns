<?php

namespace Cache\Domain;

class User
{
    private function __construct(
        private readonly int $id,
        private string       $name,
        private string       $email,
        private string       $status,
        private string       $price
    ) {
    }

    public static function create(
        int    $id,
        string $name,
        string $email,
        string $status,
        string $price
    ): User {
        return new self($id, $name, $email, $status, $price);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}
