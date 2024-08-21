<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events;

interface EventBusInterface
{
    public function publish(DomainEvent ...$events): void;
}
