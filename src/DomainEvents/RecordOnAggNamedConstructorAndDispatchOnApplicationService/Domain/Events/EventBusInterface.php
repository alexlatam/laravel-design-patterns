<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

interface EventBusInterface
{
    public function publish(array $event): void;
//    public function publish(DomainEvent ...$event): void;
}
