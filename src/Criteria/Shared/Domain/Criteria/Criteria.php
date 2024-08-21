<?php

declare(strict_types=1);

namespace Criteria\Shared\Domain\Criteria;

use Mockery\Exception;

/**
 * Criteria es un objeto que contiene los filtros, orden, pageSize y pageNumber [estos ultimos dos son para paginacion]
 * Es basicamente un DTO.
 * Estructura de Criteria [Peticion GET Http]:
 * /api/users/?filters[0][field]=name
 *            &filters[0][operator]=like
 *            &filters[0][value]=jose
 *            &orderBy=name
 *            &order=asc
 *            &offset=0
 *            &limit=10
 */
final readonly class Criteria
{
    public function __construct(
        /**
         * campo de tipo Filters, que es una coleccion[array] de objetos Filter
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
        private ?int $pageSize,
        /**
         * Number of page. [1, 2, 3, 4, ...]
         */
        private ?int $pageNumber,
    ) {
        if (!is_null($pageNumber) && is_null($pageSize)) {
            throw new Exception("Page size is required when page number is defined");
        }
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
        return !is_null($this->pageSize);
    }

    public function hasPageNumber(): bool
    {
        return !is_null($this->pageNumber);
    }

    public function filters(): Filters
    {
        return $this->filters;
    }

    public function order(): ?Order
    {
        return $this->order;
    }

    public function pageSize(): ?int
    {
        return $this->pageSize;
    }

    public function pageNumber(): ?int
    {
        return $this->pageNumber;
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

    public static function fromPrimitives(
        array $filters,
        ?string $orderBy,
        ?string $order,
        ?int $pageSize,
        ?int $pageNumber
    ): self {
        return new self(
            Filters::fromValues($filters),
            Order::fromValues($orderBy, $order),
            $pageSize,
            $pageNumber
        );
    }
}
