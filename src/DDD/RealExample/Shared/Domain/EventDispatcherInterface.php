<?php

namespace DDD\RealExample\Shared\Domain;

interface EventDispatcherInterface
{
    public function dispatch(Event $event): void;
}
