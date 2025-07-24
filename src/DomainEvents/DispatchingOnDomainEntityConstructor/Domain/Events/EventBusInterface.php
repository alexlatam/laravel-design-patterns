<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Domain\Events;

interface EventBusInterface
{
    public function publish(DomainEvent ...$events): void;
}
