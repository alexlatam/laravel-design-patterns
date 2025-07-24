<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
