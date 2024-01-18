<?php

namespace DomainEvents\DispatchingOnApplicationServices\Domain\Contracts;

use DomainEvents\DispatchingOnApplicationServices\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
