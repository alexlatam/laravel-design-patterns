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
     */
    public function pullDomainEvents(): array
    {
        // obtenemos los eventos que se han registrado
        $events = $this->events;
        // limpiamos el array de eventos
        $this->events = [];

        // retornamos los eventos
        return $events;
    }
}
