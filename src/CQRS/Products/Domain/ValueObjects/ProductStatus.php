<?php

namespace CQRS\Products\Domain\ValueObjects;

class ProductStatus
{
    const REMOVED = 0;
    const AVAILABLE = 1;
    const WITHOUT_STOCK = 2;

    public function __construct(private readonly int $value)
    {
        if (!in_array($this->value, [self::AVAILABLE, self::REMOVED, self::WITHOUT_STOCK])) {
            throw new \InvalidArgumentException('Invalid product status.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
