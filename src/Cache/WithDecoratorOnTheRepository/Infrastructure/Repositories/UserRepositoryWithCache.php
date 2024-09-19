<?php

namespace Cache\Infrastructure\Repositories;

use App\Models\User;
use Cache\Domain\IUserRepository;
use Cache\Domain\User as UserEntity;
use Cache\Domain\Users;
use Cache\Infrastructure\Cache\MemoryCache;

final readonly class UserRepositoryWithCache implements IUserRepository
{
    public function __construct(private MemoryCache $cache)
    {
    }

    public function getUsers(string $status, string $price): Users
    {
        $key = $status . $price;

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $users = User::where('status', $status)
            ->where('price', $price)
            ->get();

        $this->cache->set($key, $users);

        return $this->toEntityUsers($users->toArray());
    }

    private function toEntityUsers(array $users): Users
    {
        $usersEntity = new Users();
        foreach ($users as $user) {
            $user = UserEntity::create(
                    $user['id'],
                    $user['name'],
                    $user['email'],
                    $user['status'],
                    $user['price'],
            );
            $usersEntity->addUser($user);
        }
        return $usersEntity;
    }
}
