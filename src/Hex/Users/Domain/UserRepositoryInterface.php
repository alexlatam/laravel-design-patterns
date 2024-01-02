<?php

namespace Hex\Users\Domain;

use Hex\Users\Domain\User as UserEntity;

interface UserRepositoryInterface
{
    public function findOrFail(string $id): UserEntity;

    public function save(UserEntity $user): void;
}
