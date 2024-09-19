<?php

namespace Cache\Domain;

class Users
{
    private array $users = [];

    public function __construct()
    {
    }

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}
