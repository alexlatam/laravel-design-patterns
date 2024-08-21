<?php

namespace App\Http\Resources\Api\V1;

use App\Models\V1\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {

        return $this->collection->map(function (Category $category) {
            // Formato de salida
            return [
                'id' => $category->id,
                'type' => 'category',
                'attributes' => [
                    'name' => $category->name,
                ]
            ];
        })->toArray();
    }
}
