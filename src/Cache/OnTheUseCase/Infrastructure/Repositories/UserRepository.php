<?php

namespace Cache\OnTheUseCase\Infrastructure\Repositories;

use App\Models\User;
use Cache\OnTheUseCase\Domain\IUserRepository;
use Cache\OnTheUseCase\Domain\Users;

class UserRepository implements IUserRepository
{
    public function getUsers(string $status, string $price): Users
    {
        $users = User::where('status', $status)
            ->where('price', $price)
            ->get();
        return $this->toEntityUsers($users->toArray());
    }

    private function toEntityUsers(array $users): Users
    {
        $usersEntity = new Users();
        foreach ($users as $user) {
            $usersEntity->addUser(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['status'],
                $user['price'],
            );
        }
        return $usersEntity;
    }
}
