<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        // Fomrato de respuesta para recursos individuales de Tags.
        return [
            'id' => $this->resource->id,
            'type' => 'tag',
            'attributes' => [
                'name' => $this->resource->name,
            ],
            'relationships' => [
                'recipes' => RecipeResource::collection($this->resource->recipes)
            ],
        ];
    }
}
