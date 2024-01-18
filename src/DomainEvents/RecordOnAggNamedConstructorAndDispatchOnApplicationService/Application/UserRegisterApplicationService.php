<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Application;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts\UserRepositoryInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\EventBusInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\User;

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

    /**
     * El comando [UserRegisterCommand] es el DTO que contiene los datos necesarios para crear un usuario
     * Este comando viene desde el controlador [UserController]
     * Una alternativa es pasar directamente los datos en primitivos [string, int, bool, etc]
     */
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
         * Los eventos que se han generado en el agregado son:
         * - Usuario Registrado [UserRegisteredDomainEvent]
         */
        $this->eventBus->publish($user->pullDomainEvents());
    }
}
