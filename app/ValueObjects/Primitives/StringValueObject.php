<?php

namespace App\ValueObjects\Primitives;

use App\ValueObjects\ValueObject;
use Illuminate\Support\Stringable;
use InvalidArgumentException;

abstract class StringValueObject extends ValueObject
{
    protected string|Stringable $value;

    protected function __construct(string|Stringable $value)
    {
        $this->value = trim($value);

        $this->validate();
    }

    public function value(): string|Stringable
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
