<?php

namespace CQRS\Products\Infrastructure\Repositories;

use CQRS\Products\Domain\Product;
use CQRS\Products\Domain\Repositories\ProductRepositoryInterface;
use CQRS\Products\Domain\ValueObjects\ProductId;
use Illuminate\Support\Facades\DB;

final class EloquentProductRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        // Implementation to save the product using Eloquent ORM
        DB::insert('INSERT INTO products (id, title, price, status) VALUES (?, ?, ?, ?)', [
            $product->id(),
            $product->title(),
            $product->price(),
            $product->status(),
        ]);
    }

    public function find(ProductId $id): ?Product
    {
        $product = DB::selectOne('SELECT * FROM products WHERE id = ?', [$id->value()]);

        if (is_null($product)) {
            return null;
        }

        return Product::build(
            $product->id,
            $product->title,
            $product->price,
            $product->status,
            $product->image,
        );
    }
}
