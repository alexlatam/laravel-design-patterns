<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

class UserArchivedDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $aggregateId,
        private readonly string $status,
        string                  $eventId = null,
        string                  $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->aggregateId,
            'status' => $this->status
        ];
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['status'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'application_name.bounded_context.user.archived';
    }

    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
