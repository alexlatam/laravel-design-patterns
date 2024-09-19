<?php

namespace Cache\OnTheUseCase\Domain;

class Users
{
    private array $users;

    public function __construct()
    {
        $this->users = [];
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
