<?php

declare(strict_types=1);

namespace App\Criteria;

final readonly class Criteria
{
    public function __construct(
        /**
         * campo de tipo Filters, que es una coleccion de objetos Filter
         * Cada Filter es un campo de la tabla que se quiere filtrar
         */
        private Filters $filters,
        /**
         * Ascendente o descendente [Asc, Desc]
         */
        private ?Order $order,
        /**
         * Offset. [0, 10, 20, 30, ...]
         */
        private ?int $offset,
        /**
         * Limite. [10, 20, 30, 40, ...]
         */
        private ?int $limit,
    ) {
    }

    public function hasFilters(): bool
    {
        return $this->filters->count() > 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function hasLimit(): bool
    {
        return !is_null($this->limit);
    }

    public function hasOffset(): bool
    {
        return !is_null($this->offset);
    }

    public function plainFilters(): array
    {
        return $this->filters->filters();
    }

    public function filters(): Filters
    {
        return $this->filters;
    }

    public function order(): ?Order
    {
        return $this->order;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function serialize(): string
    {
        return sprintf(
            '%s~~%s~~%s~~%s',
            $this->filters->serialize(),
            $this->order->serialize(),
            $this->offset ?? 'none',
            $this->limit ?? 'none'
        );
    }
}
