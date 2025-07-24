<?php

namespace Hex\Shared;

interface UserRepository
{
    public function add(User $user): void;
}
