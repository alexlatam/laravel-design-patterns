<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CategoryCollection;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\V1\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    public function show(Category $category)
    {
        $category = $category->load('recipes.category', 'recipes.tags', 'recipes.user');

        return new CategoryResource($category);
    }
}
