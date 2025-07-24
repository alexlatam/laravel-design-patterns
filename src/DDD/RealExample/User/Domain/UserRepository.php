<?php

namespace DDD\RealExample\User\Domain;

interface UserRepository
{
    public function save(User $user): void;
    public function findByEmail(string $email): ?User;
}
