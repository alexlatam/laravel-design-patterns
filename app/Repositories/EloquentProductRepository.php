<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

final class EloquentProductRepository implements ProductRepositoryInterface
{
    public function paginated(): AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::with(['user'])->orderByDesc('id')
            ->paginate(5));
    }

    public function create(): Model
    {
        return Product::create(request()->only('name', 'description', 'price'));
    }

    public function update(int $id): bool
    {
        return Product::where('id', $id)->update(request()->only('name', 'description', 'price'));
    }

    public function delete(int $id): bool
    {
        return Product::destroy($id);
    }

    public function find(int $id): JsonResource
    {
        $product = Product::find($id);
        if (is_null($product)){
            throw new ModelNotFoundException('Product not found.');
        }
        return new ProductResource($product);
    }


    public function findOrFail(int $id): JsonResource
    {
        // TODO: Implement findOrFail() method.
    }
}
