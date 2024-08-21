<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'type' => 'recipe',
            'attributes' => [
                'category'      => $this->resource->category->name,
                'author'        => $this->resource->user->name,
                'title'         => $this->resource->title,
                'description'   => $this->resource->description,
                'ingredients'   => $this->resource->ingredients,
                'instructions'  => $this->resource->instructions,
                'image'         => asset($this->resource->image), // folder/file.png -> http://.../folder/file.png
                'tags'          => $this->resource->tags->pluck('name')->implode(', '),
            ],
        ];
    }
}
