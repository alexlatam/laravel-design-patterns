<?php

namespace Hex\Backoffice\Posts\Domain\Contracts;

use Hex\Backoffice\Posts\Domain\UserEntity;

interface UserRepositoryInterface
{
    public function findOrFail(string $id): UserEntity;
}
