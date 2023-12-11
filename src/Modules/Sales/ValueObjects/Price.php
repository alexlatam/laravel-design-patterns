<?php

namespace Modules\Sales\ValueObjects;

use InvalidArgumentException;

final class Price
{
    public function __construct(protected int $price)
    {
        if($price < 0) {
            throw new InvalidArgumentException('Price cannot be negative');
        }
    }

    public static function from(int $price): self
    {
        return new self($price);
    }

    public function toNative(): int
    {
        return $this->price;
    }
}
