<?php

namespace Hex\Backoffice\Users\Domain;

use Hex\Backoffice\Users\Domain\User as UserEntity;

interface UserRepositoryInterface
{
    public function findOrFail(string $id): UserEntity;

    public function save(UserEntity $user): void;
}
