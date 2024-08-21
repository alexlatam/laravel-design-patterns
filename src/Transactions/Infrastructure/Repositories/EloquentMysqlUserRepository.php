<?php

namespace Transactions\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Transactions\Domain\IUserRepository;
use Transactions\Domain\User;

class EloquentMysqlUserRepository implements IUserRepository
{
    /**
     * @throws Exception
     */
    public function store(User $user): void
    {
        \App\Models\User::create([
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail()
        ]);

        DB::table('users_legacy')->insert([
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail()
        ]);
    }
}
