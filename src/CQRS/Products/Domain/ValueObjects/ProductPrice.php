<?php

namespace CQRS\Products\Domain\ValueObjects;

readonly class ProductPrice
{
    public function __construct(private float $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Product price cannot be negative.');
        }
    }

    public function value(): float
    {
        return $this->value;
    }
}
