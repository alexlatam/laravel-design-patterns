<?php

namespace Cache\Application;

use Cache\Domain\IUserRepository;
use Cache\Domain\Users;
use Cache\Domain\ICache;

/**
 * Cache en la capa de Aplicacion [Application] [Use Case]
 */
final readonly class GetUsersWithCacheOnThisUseCase
{
    public function __construct(
        private IUserRepository $userRepository,
        private ICache          $cache,
    ) {
    }

    public function __invoke(GetUsersDto $GetUsersDto): Users
    {
        $status = $GetUsersDto->getStatus();
        $price = $GetUsersDto->getPrice();

        $key = $status . $price;

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $users = $this->userRepository->getUsers($status, $price);

        $this->cache->set($key, $users);

        return $users;
    }
}
