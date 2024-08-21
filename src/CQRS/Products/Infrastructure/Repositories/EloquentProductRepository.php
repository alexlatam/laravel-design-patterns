<?php

namespace CQRS\Products\Infrastructure\Repositories;

use CQRS\Products\Domain\Product;
use CQRS\Products\Domain\Repositories\ProductRepositoryInterface;
use CQRS\Products\Domain\ValueObjects\ProductId;

final class EloquentProductRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        // TODO: Implement save() method.
    }

    public function find(ProductId $id): ?Product
    {
        return null;
    }
}
