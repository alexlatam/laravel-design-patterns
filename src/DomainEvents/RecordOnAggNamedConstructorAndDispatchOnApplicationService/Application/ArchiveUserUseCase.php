<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Application;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts\UserRepositoryInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\EventBusInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Exceptions\UserDoesNotExist;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Services\UserFinderDomainService;

readonly class ArchiveUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EventBusInterface       $eventBus,
        private UserFinderDomainService $userFinderDomainService,
    ) {}

    /**
     * El comando [UserRegisterCommand] es el DTO que contiene los datos necesarios para crear un usuario
     * Este comando viene desde el controlador [UserController]
     * Una alternativa es pasar directamente los datos en primitivos [string, int, bool, etc]
     * @throws UserDoesNotExist
     */
    public function __invoke(UserRegisterCommand $command): void
    {
        $user = $this->userFinderDomainService->find($command->id());

        /**
         * Archivamos el usuario. Cambiamos su estado a archivado.
         */
        $user->archive();

        $this->userRepository->save($user);

        /**
         * Aqui despachamos [disparamos, publicamos] los eventos de dominio que se han generado en el agregado
         * El metodo que despacha los eventos, puede llamarse: dispatch, publish, raise, emit, notify, etc.
         * Los eventos que se han generado en el agregado son:
         * - Usuario Archivado [UserArchivedDomainEvent]
         */
        $this->eventBus->publish($user->pullDomainEvents());
    }

}
