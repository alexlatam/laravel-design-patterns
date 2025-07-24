<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Domain\User;

use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\Events\DomainEvent;

final class UserRegisteredDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $email
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
}
