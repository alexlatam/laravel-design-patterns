<?php

namespace Core\Domain;

use InvalidArgumentException;

class StringValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = trim($value);

        $this->validate();
    }

    public function value(): string
    {
        return (string) $this->value;
    }

    protected function validate(): void
    {
        if (empty($this->value)) {
            throw new InvalidArgumentException('El texto no puede estar vacio');
        }
    }
}
