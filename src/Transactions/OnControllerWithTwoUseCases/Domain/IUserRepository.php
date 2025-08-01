<?php

namespace Transactions\OnControllerWithTwoUseCases\Domain;

interface IUserRepository
{
    public function store(User $user): void;
}
