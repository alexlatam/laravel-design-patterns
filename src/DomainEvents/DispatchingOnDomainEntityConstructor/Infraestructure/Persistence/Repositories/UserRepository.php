<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Infraestructure\Persistence\Repositories;

use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User\User;
use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        // Aqui se persiste el usuario en la base de datos
    }
}
