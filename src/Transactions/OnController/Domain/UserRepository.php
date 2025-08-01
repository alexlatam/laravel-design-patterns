<?php

namespace Transactions\OnController\Domain;

interface UserRepository
{
    public function store(User $user): void;
}
