<?php

namespace CQRS\Products\Domain\Repositories;

use CQRS\Products\Domain\Product;
use CQRS\Products\Domain\ValueObjects\ProductId;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function find(ProductId $id): ?Product;
}
