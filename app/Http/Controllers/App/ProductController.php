<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;

class ProductController extends Controller
{
    public function index() {
        $products = FeaturedProduct::get();
        return response()->json($products);
    }

    public function store() {
        $this->validate(request(), [
            "name" => "required|string|max:100|unique:products",
            "description" => "required|string|max:1000",
            "stock" => "required|numeric",
            "available" => "required|boolean",
        ]);

        FeaturedProduct::create([
            "name" => request("name"),
            "description" => request("description"),
            "stock" => request("stock"),
            "available" => request("available"),
        ]);
        return response()->json([], 201);
    }

    public function show(int $id) {
        $product = FeaturedProduct::findOrFail($id);
        return response()->json($product);
    }

    public function findByName(string $name) {
        $product = FeaturedProduct::whereName($name)->firstOrFail();
        return response()->json($product);
    }

    public function update(int $id) {
        $product = FeaturedProduct::findOrFail($id);
        $product->update(request()->all());
        return response()->json($product);
    }

    public function destroy(int $id) {
        $product = FeaturedProduct::findOrFail($id);
        $product->delete();
        return response()->json([], 201);
    }
}
