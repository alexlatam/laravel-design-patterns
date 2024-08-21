<?php

namespace Transactions\Domain;

interface IUserRepository
{
    public function store(User $user): void;
}
