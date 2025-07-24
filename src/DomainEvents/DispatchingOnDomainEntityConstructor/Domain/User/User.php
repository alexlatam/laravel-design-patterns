<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User;

class User
{
    function __construct(
        private readonly UserId $uuid,
        private UserName $name,
        private UserEmail $email,
        private UserPassword $password,
    ) {
        /**
         * Aqui despachamos [disparamos, publicamos] los eventos de dominio que se han generado en el agregado
         * El metodo que despacha los eventos, puede llamarse: dispatch, publish, raise, emit, notify, etc.
         */
        EventBus::publish(
            new UserRegisteredDomainEvent(
                $uuid->value(),
                $name->value(),
                $email->value(),
            ));
    }

    public static function create(string $id, string $name, string $email, string $password): self
    {
        return new self(
            uuid: new UserId($id),
            name: new UserName($name),
            email: new UserEmail($email),
            password: new UserPassword($password),
        );
    }

    public function getUuid(): UserId
    {
        return $this->uuid;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->uuid->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
        ];
    }
}
