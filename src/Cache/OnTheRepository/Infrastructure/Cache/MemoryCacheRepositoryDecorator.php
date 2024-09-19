<?php

namespace Cache\Infrastructure\Cache;

use Cache\Domain\IUserRepository;
use Cache\Domain\Users;

/**
 * Decorador del Repositorio de Usuarios con Cache en Memoria
 * Este decorador recibe la clase que va a decorar. En este caso el repositorio de usuarios
 * Ademas, recibe la clase encargada de la cache en memoria
 *
 * Un decorador es una clase que implementa la misma interfaz que la clase que va a decorar
 */
final readonly class MemoryCacheRepositoryDecorator implements IUserRepository
{
    public function __construct(
        private IUserRepository $repository,
        private MemoryCache     $cache,
    ) {
    }

    public function getUsers(string $status, string $price): Users
    {
        $key = $status . $price;

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $users = $this->repository->getUsers($status, $price);
        $this->cache->set($key, $users);

        return $users;
    }
}
