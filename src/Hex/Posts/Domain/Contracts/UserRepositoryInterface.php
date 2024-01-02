<?php

namespace Hex\Posts\Domain\Contracts;

use Hex\Posts\Domain\UserEntity;

interface UserRepositoryInterface
{
    public function findOrFail(string $id): UserEntity;
}
