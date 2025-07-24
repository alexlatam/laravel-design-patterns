<?php

namespace DomainEvents\DispatchingOnApplicationServices\Infraestructure\Buses;

use DomainEvents\DispatchingOnApplicationServices\Domain\Events\DomainEvent;
use DomainEvents\DispatchingOnApplicationServices\Domain\Events\EventBusInterface;

class EventBus implements EventBusInterface
{
    public function publish(DomainEvent ...$events): void
    {
        // TODO: Implement publish() method.
    }
}
