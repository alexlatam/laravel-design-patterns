<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,

            // Para agregar una relacion con otros posts [relaciones del modelo].
            // 'relatedPosts' es el nombre de la relacion en el modelo.
            // 'relatedPosts' => BlogPostResource::collection($this->whenLoaded('relatedPosts')),
        ];
    }
}
