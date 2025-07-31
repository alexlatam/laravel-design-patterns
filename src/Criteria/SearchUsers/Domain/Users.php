<?php

namespace Criteria\SearchUsers\Domain;

class Users
{
    private array $users = [];

    public function getUsers(): array
    {
        return $this->users;
    }

    public function addUser(User $user): void
    {
        // verify if a user with the same ID already exists
        /** @var User $existingUser */
        foreach ($this->users as $existingUser) {
            if ($existingUser->equals($user)) {
                throw new \InvalidArgumentException('User with the same ID already exists.');
            }
        }
        $this->users[] = $user;
    }

    public function removeUser(User $user): void
    {
        $this->users = array_filter($this->users, fn($u) => $u !== $user);
    }

    public function isEmpty(): bool
    {
        return empty($this->users);
    }
}
