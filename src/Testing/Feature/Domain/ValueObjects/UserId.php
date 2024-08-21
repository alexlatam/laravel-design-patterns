<?php

declare(strict_types = 1);

namespace Testing\Feature\Domain\ValueObjects;

final class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
