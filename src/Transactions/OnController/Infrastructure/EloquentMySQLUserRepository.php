<?php

namespace Transactions\OnController\Infrastructure;

use Transactions\OnController\Domain\User;
use Transactions\OnController\Domain\UserRepository;

class EloquentMySQLUserRepository implements UserRepository
{
    public function store(User $user): void
    {
        // Assuming you have a User model that corresponds to your users table
        \App\Models\User::create([
            'id' => $user->id(),
            'firstname' => $user->firstname(),
            'lastname' => $user->lastname(),
            'email' => $user->email(),
        ]);

        // update user id on another table
        \App\Models\AnotherModel::where('user_id', $user->id())
            ->update(['user_id' => $user->id()]);
    }
}
