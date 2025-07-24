<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\UserArchivedDomainEvent;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\UserEmailUpdatedDomainEvent;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\UserNameUpdatedDomainEvent;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\UserRegisteredDomainEvent;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserEmail;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserId;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserName;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserPassword;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserStatus;
use Exception;

class User extends AggregateRoot
{
    private UserStatus $status;

    function __construct(
        private readonly UserId       $uuid,
        private UserName              $name,
        private UserEmail             $email,
        private readonly UserPassword $password,
    )
    {
        $this->status = new UserStatus(UserStatus::ACTIVE);
    }

    public static function create(string $id, string $name, string $email, string $password): self
    {
        $user = new self(
            uuid: new UserId($id),
            name: new UserName($name),
            email: new UserEmail($email),
            password: new UserPassword($password),
        );

        /**
         * Registramos el evento de dominio en el agregado.
         * El evento registrado es: Usuario Registrado [UserRegisteredDomainEvent]
         */
        $user->record(new UserRegisteredDomainEvent(
            aggregateId: $user->uuid->value(),
            name: $user->name->value(),
            email: $user->email->value()
        ));

        return $user;
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->uuid->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'password' => $this->password->value(),
        ];
    }

    public function updateEmail(string $email): void
    {
        $this->email = new UserEmail($email);

        $this->record(new UserEmailUpdatedDomainEvent(
            aggregateId: $this->uuid->value(),
            email: $this->email->value(),
        ));
    }

    public function updateName(string $name): void
    {
        $this->name = new UserName($name);

        $this->record(new UserNameUpdatedDomainEvent(
            aggregateId: $this->uuid->value(),
            name: $this->name->value(),
        ));
    }

    /**
     * Metdo para archivar un usuario
     * @throws Exception
     */
    public function archive(): void
    {
        if($this->isArchived()) {
            throw new Exception('This user is already archived');
        }
        if($this->isActive()) {
            throw new Exception('An active user cannot be archived');
        }

        $this->status = new UserStatus(UserStatus::ARCHIVED);

        $this->record(new UserArchivedDomainEvent(
            aggregateId: $this->uuid->value(),
            status: $this->status->value(),
        ));
    }

    private function isArchived(): bool
    {
        return $this->status->value() === UserStatus::ARCHIVED;
    }

    private function isActive(): bool
    {
        return $this->status->value() === UserStatus::ACTIVE;
    }
}
