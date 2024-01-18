<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\UserRegisteredDomainEvent;

class User extends AggregateRoot
{
    function __construct(
        private readonly UserId       $uuid,
        private readonly UserName     $name,
        private readonly UserEmail    $email,
        private readonly UserPassword $password,
    ) {}

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
            id: $user->uuid->value(),
            name: $user->name->value(),
            email: $user->email->value(),
            password: $user->password->value(),
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
}
