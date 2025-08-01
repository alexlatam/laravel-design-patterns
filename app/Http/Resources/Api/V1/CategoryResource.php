<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'category',
            'attributes' => [
                'name' => $this->resource->name,
            ],
            'relationships' => [
                'recipes' => RecipeResource::collection($this->resource->recipes)
            ],
        ];
    }
}
