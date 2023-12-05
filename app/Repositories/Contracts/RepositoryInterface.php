<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

interface RepositoryInterface
{
    public function paginated(): AnonymousResourceCollection;
    public function create(): Model;
    public function update(int $id): bool;
    public function delete(int $id): bool;
    public function find(int $id): JsonResource;
}
