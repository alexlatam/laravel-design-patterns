<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Application;

use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User\User;
use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User\UserRepositoryInterface;

/**
 * Este es el caso de uso [Servicio de Aplicacion][Application Service] que se encarga de orquestar la creación de un usuario
 * Incluyendo el despacho de los eventos de dominio que se han generado
 */
final readonly class UserRegisterApplicationService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function execute(UserRegisterCommand $command): void
    {
        $user = User::create(
            $command->id(),
            $command->name(),
            $command->email(),
            $command->password(),
        );

        $this->userRepository->save($user);
    }
}
