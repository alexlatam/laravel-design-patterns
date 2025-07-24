<?php

namespace DDD\RealExample\Shared\Domain;

abstract class Event
{
    abstract public function occurredOn(): string;
}
