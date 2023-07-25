<?php

namespace App\ValueObjects\Primitives;

use App\ValueObjects\ValueObject;
use Illuminate\Support\Stringable;
use InvalidArgumentException;

class Text extends ValueObject
{
    protected string|Stringable $value;

    protected array $trueValues = ['true', '1', 'on', 1, 'yes', 'si', 'sí'];
    protected array $falseValues = ['false', '0', 'off', 0, 'no'];

    public function __construct(bool|int|string|Stringable $value)
    {
        !is_bool($value) ? $this->handleNonBoolean($value) : $this->value = $value;

        $this->validate();
    }

    public function value(): bool
    {
        return $this->value;
    }

    protected function handleNonBoolean(int|string $value): void
    {
        $string = new Stringable($value);

        $this->value = match (true) {
            $string->contains($this->trueValues, ignoreCase: true) => true,
            $string->contains($this->falseValues, ignoreCase: true) => true,
            default => throw new InvalidArgumentException('El valor no es booleano'),
        };
    }

    public function toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
