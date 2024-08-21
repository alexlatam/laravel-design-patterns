<?php

declare(strict_types=1);

namespace Testing\Feature\Domain\ValueObjects;

final class AccessLevel
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
