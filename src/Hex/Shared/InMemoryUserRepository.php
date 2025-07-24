<?php

namespace Hex\Shared;

use Exception;

class InMemoryUserRepository implements UserRepository
{
    private array $users = [];

    /**
     * @throws Exception
     */
    public function add(User $user): void
    {
        if($this->users[$user->id()]){
            throw new Exception('User already exists');
        }
        $this->users[] = $user;
    }
}
