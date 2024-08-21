<?php

namespace App\Http\Resources\Api\V1\Advertisements;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'lastname' => $this->resource->lastname,
        ];
    }
}
