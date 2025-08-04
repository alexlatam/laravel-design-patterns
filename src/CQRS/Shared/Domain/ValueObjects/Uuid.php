<?php

namespace CQRS\Shared\Domain\ValueObjects;

use CQRS\Shared\Domain\UuidGenerator;
use InvalidArgumentException;
use Stringable;

class Uuid implements Stringable
{
    final public function __construct(protected string $value) {
        $this->ensureIsValidUuid($value);
    }

    final public static function random(): self
    {
        return new static(UuidGenerator::generate());
    }

    final public function value(): string
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function ensureIsValidUuid(string $id): void
    {
        if (!UuidGenerator::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', self::class, $id));
        }
    }
}
