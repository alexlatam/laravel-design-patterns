<?php

namespace App\Repositories\Contracts;

use App\Entities\Review;

interface ReviewRepositoryInterface
{
    public function findOrFail(int $id): Review;

    public function save(Review $review): void;
}
