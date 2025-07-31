<?php

namespace Transactions\OnTheRepository\Infrastructure;

use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;
use Transactions\OnTheRepository\Domain\User;
use Transactions\OnTheRepository\Domain\UserRepository;

class EloquentMySQLUserRepository implements UserRepository
{
    /**
     * @throws Throwable
     */
    public function store(User $user): void
    {
        try {
            DB::beginTransaction();
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
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // Se lanza la misma excepción para que el controlador la capture y devuelva una respuesta adecuada
            throw $e;
        }
    }
}
