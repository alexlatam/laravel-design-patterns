<?php

namespace App\Http\Resources\Api\V1\Advertisements;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'status' => $this->resource->status,
            'final_date' => $this->resource->final_date,
            'created_at' => $this->resource->created_at,
            'user' => UserResource::make($this->resource->user), // relationship
            'category' => CategoryResource::make($this->resource->category), // relationship
        ];
    }
}
