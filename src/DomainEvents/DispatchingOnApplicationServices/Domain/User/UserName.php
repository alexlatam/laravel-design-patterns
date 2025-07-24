<?php

namespace DomainEvents\DispatchingOnApplicationServices\Domain\User;

final readonly class UserName
{
    public function __construct(private string $value) {}

    public function value(): string
    {
        return $this->value;
    }
}
