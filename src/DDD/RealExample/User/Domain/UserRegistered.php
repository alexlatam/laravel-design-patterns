<?php

namespace DDD\RealExample\User\Domain;

use DateTimeImmutable;
use DDD\RealExample\Shared\Domain\Event;

class UserRegistered extends Event
{
    private string $id;
    private string $email;
    private string $occurredOn;

    public function __construct(
        string $id,
        string $email,
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->occurredOn = (new DateTimeImmutable())->getTimestamp();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }
}
