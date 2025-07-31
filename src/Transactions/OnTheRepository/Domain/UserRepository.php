<?php

namespace Transactions\OnTheRepository\Domain;

interface UserRepository
{
    public function store(User $user): void;
}
