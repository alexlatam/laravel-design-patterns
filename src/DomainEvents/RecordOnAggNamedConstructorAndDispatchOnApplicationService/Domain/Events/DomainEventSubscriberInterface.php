<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

interface DomainEventSubscriberInterface
{
//    public function on(DomainEvent $event): void;

    public function subscribedTo(): array;
}
