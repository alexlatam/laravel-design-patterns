<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\CrudController;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;

final class ProductController extends CrudController
{
    protected string $resource = 'products';
    protected string $formRequest = ProductRequest::class;
    protected RepositoryInterface $repository;

    protected string $messageStored = 'Product stored successfully.';
    protected string $messageUpdated = 'Product updated successfully.';
    protected string $messageDeleted = 'Product deleted successfully.';

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function formCreateMetaData(): array
    {
        $product = new Product();
        $title = __('Create Product');
        $textButtonSubmit = __('Create');
        $route = route($this->resource . '.store');
        return compact('product', 'title', 'textButtonSubmit', 'route');
    }

    protected function formUpdateMetaData(): array
    {
        $product = $this->repository->find(request()->route('product'));
        $update = true;
        $title = __('Update Product');
        $textButtonSubmit = __('Update');
        $route = route($this->resource . '.update', ["product" => $product]);
        return compact('product', 'update', 'title', 'textButtonSubmit', 'route');
    }
}
