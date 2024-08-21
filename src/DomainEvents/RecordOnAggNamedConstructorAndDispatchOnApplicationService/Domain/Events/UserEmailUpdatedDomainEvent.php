<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

final class UserEmailUpdatedDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $aggregateId,
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
            'email' => $this->email
        ];
    }

    public static function eventName(): string
    {
        return 'application_name.bounded_context.user.email_updated';
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self($aggregateId, $body['email'], $eventId, $occurredOn);
    }
}
