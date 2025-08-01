<?php

namespace Transactions\OnRepositoryWithDecorator\Domain;

interface IUserRepository
{
    public function store(User $user): void;
}
