<?php

namespace Cache\OnTheUseCase\Application;

use Cache\OnTheUseCase\Domain\ICache;
use Cache\OnTheUseCase\Domain\IUserRepository;
use Cache\OnTheUseCase\Domain\Users;

/**
 * Cache en la capa de Aplicacion [Application] [Use Case]
 * Esta cache se puede implementar inyectando una implementacion de la cache.
 * No necesariamente acoplado a la infraestructura. No directamente.
 */
final readonly class GetUsersWithCacheOnThisUseCase
{
    public function __construct(
        private IUserRepository $userRepository,
        private ICache          $cache,
    ) {
    }

    public function execute(GetUsersDto $GetUsersDto): Users
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
