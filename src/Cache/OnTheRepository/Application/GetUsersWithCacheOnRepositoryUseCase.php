<?php

namespace Cache\OnTheRepository\Application;

use Cache\Application\GetUsersDto;
use Cache\Domain\IUserRepository;
use Cache\Domain\Users;

/**
 * En este caso no se esta utilizando cache en la capa de aplicacion
 * La Cache se encuentra en la capa de infraestructura. En el repositorio
 */
final readonly class GetUsersWithCacheOnRepositoryUseCase
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {
    }

    public function __invoke(GetUsersDto $GetUsersDto): Users
    {
        $status = $GetUsersDto->getStatus();
        $price = $GetUsersDto->getPrice();

        return $this->userRepository->getUsers($status, $price);
    }
}
