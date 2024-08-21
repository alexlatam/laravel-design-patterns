<?php

namespace App\Http\Resources\Api\V1\Advertisements;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdvertisementCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection, // AdvertisementResource::collection($this->collection)
            'links' => [
                'total' => $this->total(),
                'currentPage' => $this->currentPage(),
                'lastPage' => $this->lastPage(),
                'perPage' => $this->perPage(),
                'path' => $this->path(),
            ],
        ];
    }
}
