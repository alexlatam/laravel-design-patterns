<?php

namespace DDD\RealExample\User\Infrastructure\Persistence\Repositories;

use DDD\RealExample\User\Domain\User;
use DDD\RealExample\User\Domain\UserRepository;
use DDD\RealExample\User\Infrastructure\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepository
{
    public function save(User $user): void
    {
        EloquentUser::create([
            'id' => $user->id(),
            'email' => $user->email()->value(),
            'password' => $user->password()->value(),
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $eloquentUser = EloquentUser::where('email', $email)->first();

        if (!$eloquentUser) {
            return null;
        }

        return User::create(
            $eloquentUser->id,
            $eloquentUser->email,
            $eloquentUser->password
        );
    }
}
