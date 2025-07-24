<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Infraestructure\Buses;

use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\Events\DomainEvent;
use DomainEvents\DispatchingOnDomainEntityConstructor\Domain\Events\EventBusInterface;

class EventBus implements EventBusInterface
{
    public function publish(DomainEvent ...$events): void
    {
        // TODO: Implement publish() method.
    }
}
