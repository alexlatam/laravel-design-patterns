<?php

declare(strict_types=1);

namespace Criteria\Shared\Domain\Criteria;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

abstract class Collection implements Countable, IteratorAggregate
{
    public function __construct(private readonly array $items)
    {
        Assert::arrayOf($this->type(), $items);
    }

    abstract protected function type(): string;

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    protected function items(): array
    {
        return $this->items;
    }
}
