<?php

namespace DomainEvents\DispatchingOnApplicationServices\Application;

use DomainEvents\DispatchingOnApplicationServices\Domain\Events\DomainEvents;
use DomainEvents\DispatchingOnApplicationServices\Domain\Events\EventBusInterface;
use DomainEvents\DispatchingOnApplicationServices\Domain\User\User;
use DomainEvents\DispatchingOnApplicationServices\Domain\User\UserRegisteredDomainEvent;
use DomainEvents\DispatchingOnApplicationServices\Domain\User\UserRepositoryInterface;

/**
 * Este es el caso de uso [Servicio de Aplicacion][Application Service] que se encarga de orquestar la creación de un usuario
 * Incluyendo el despacho de los eventos de dominio que se han generado
 */
final readonly class UserRegisterApplicationService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EventBusInterface       $eventBus,
    ) {}

    public function __invoke(UserRegisterCommand $command): void
    {
        $user = User::create(
            $command->id(),
            $command->name(),
            $command->email(),
            $command->password(),
        );

        $this->userRepository->save($user);

        /**
         * Aqui despachamos [disparamos, publicamos] los eventos de dominio que se han generado en el agregado
         * El metodo que despacha los eventos, puede llamarse: dispatch, publish, raise, emit, notify, etc.
         */
        $this->eventBus->publish(
            new UserRegisteredDomainEvent(
                $command->id(),
                $command->name(),
                $command->email(),
                $command->password(),
        ));
    }
}
