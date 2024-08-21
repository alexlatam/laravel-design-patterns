<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

use DateTimeImmutable;
use DateTimeInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\SimpleUuid;

abstract class DomainEvent
{
    private readonly string $eventId;
    private readonly string $occurredOn;

    public function __construct(
        private readonly string $aggregateId,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        $this->eventId = $eventId ?: SimpleUuid::random()->value();
        $this->occurredOn = $occurredOn ?: (new DateTimeImmutable())->format(DateTimeInterface::ATOM);
    }

    abstract public function toPrimitives(): array;
    abstract public static function eventName(): string;

    /**
     * Este metodo servira para recrear el evento a partir de sus primitivas.
     * Estamos recreando un evento de dominio que ya ha ocurrido.
     * Por ejemplo, si el evento se recupera de un evento almacenado en una base de datos, sistema de colas, etc
     * este metodo sera el encargado de reconstruir el evento a partir de sus primitivas.
     */
    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;

    final public function eventId(): string
    {
        return $this->eventId;
    }

    final public function occurredOn(): string
    {
        return $this->occurredOn;
    }

    final public function aggregateId(): string
    {
        return $this->aggregateId;
    }
}
