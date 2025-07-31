<?php

namespace Criteria\Shared\Domain\Criteria\ValueObjects;

use InvalidArgumentException;

abstract class StringValueObject
{
    public function __construct(protected string $value) {
        $this->validate();
    }

    final public function value(): string
    {
        return $this->value;
    }

    protected function validate(): void
    {
        if (empty($this->value)) {
            throw new InvalidArgumentException('The value cannot be empty.');
        }
    }
}
