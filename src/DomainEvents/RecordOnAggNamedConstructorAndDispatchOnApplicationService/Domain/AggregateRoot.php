<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\DomainEvent;

class AggregateRoot
{
    /**
     * Array que contiene los eventos que se han producido en el agregado.
     */
    private array $events = [];

    /**
     * Metodo que se encarga de registrar los eventos que se han producido en el agregado.
     */
    protected function record(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * Metodo que se encarga de obtener los eventos que se han producido en el agregado.
     * Ademas, limpia el array de eventos.
     */
    public function pullDomainEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}
