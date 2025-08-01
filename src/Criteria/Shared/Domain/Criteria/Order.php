<?php

declare(strict_types=1);

namespace Criteria\Shared\Domain\Criteria;

final readonly class Order
{
    public function __construct(
        /**
         * Order por un cmapo especifico de la tabla
         * P.ej: 'name', 'email', 'age', etc.
         */
        private OrderBy $orderBy,

        // Tipo de orden. Ascendente, descendente o none [Asc, Desc, None]
        private OrderType $orderType
    ) {}

    public static function createDesc(OrderBy $orderBy): self
    {
        return new self($orderBy, OrderType::DESC);
    }

    public static function fromValues(?string $orderBy, ?string $order): self
    {
        return (is_null($orderBy) || is_null($order)) ? self::none() : new self(
            new OrderBy($orderBy),
            OrderType::from($order)
        );
    }

    public static function none(): self
    {
        return new self(new OrderBy(''), OrderType::NONE);
    }

    public function orderBy(): OrderBy
    {
        return $this->orderBy;
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    public function isNone(): bool
    {
        return $this->orderType()->isNone();
    }

    public function serialize(): string
    {
        return sprintf('%s.%s', $this->orderBy->value(), $this->orderType->value);
    }
}
