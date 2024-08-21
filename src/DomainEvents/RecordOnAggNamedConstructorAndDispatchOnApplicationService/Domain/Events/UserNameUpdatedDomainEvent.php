<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

final class UserNameUpdatedDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $aggregateId,
        private readonly string $name,
        string                  $eventId = null,
        string                  $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->aggregateId,
            'name' => $this->name
        ];
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn,
    ): self {
        return new self($aggregateId, $body['name'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'my_app.domain_events.user.username_updated';
    }
}
