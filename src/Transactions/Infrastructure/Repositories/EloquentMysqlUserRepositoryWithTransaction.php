<?php

namespace Transactions\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Transactions\Domain\IUserRepository;
use Transactions\Domain\User;

class EloquentMysqlUserRepositoryWithTransaction implements IUserRepository
{
    /**
     * @throws Exception
     */
    public function store(User $user): void
    {
        try {
            DB::beginTransaction();
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

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // Se lanza la misma excepción para que el controlador la capture y devuelva una respuesta adecuada
            throw $e;
        }
    }
}
