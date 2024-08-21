<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

final class UserRegisteredDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $aggregateId,
        private readonly string $name,
        private readonly string $email,
        string                  $eventId = null,
        string                  $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->aggregateId,
            'name' => $this->name,
            'email' => $this->email
        ];
    }

    public static function eventName(): string
    {
        return 'application_name.bounded_context.user.registered';
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self($aggregateId, $body['name'], $body['email'], $eventId, $occurredOn);
    }
}
