<?php

namespace DomainEvents\DispatchingOnApplicationServices\Infraestructure\Persistence\Repositories;

use DomainEvents\DispatchingOnApplicationServices\Domain\User\User;
use DomainEvents\DispatchingOnApplicationServices\Domain\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        // Aqui se persiste el usuario en la base de datos
    }
}
