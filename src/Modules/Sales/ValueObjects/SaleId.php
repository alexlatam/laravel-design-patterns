<?php

namespace Modules\Sales\ValueObjects;

use InvalidArgumentException;

final class SaleId
{
    public function __construct(protected string $sale_id)
    {
        if(empty($this->sale_id)) {
            throw new InvalidArgumentException('Sale id cannot be empty');
        }
    }

    public static function from(string $sale_id): self
    {
        return new self($sale_id);
    }

    public function toNative(): string
    {
        return $this->sale_id;
    }
}
