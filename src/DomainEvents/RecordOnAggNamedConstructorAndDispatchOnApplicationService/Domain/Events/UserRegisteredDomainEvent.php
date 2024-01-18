<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

final class UserRegisteredDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
