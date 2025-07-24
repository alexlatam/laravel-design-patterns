<?php

namespace DDD\WithEventDispatcherOnUseCase\Infrastructure\Repositories;

use DDD\WithEventDispatcherOnUseCase\Domain\ReviewRepository;
use Illuminate\Support\Facades\DB;

class EloquentReviewRepository implements ReviewRepository
{
    public function update(string $reviewId, string $reviewTitle): void
    {
        // Update review in database
        DB::query()->update((array)'UPDATE reviews SET title = ? WHERE id = ?', [$reviewTitle, $reviewId]);
    }
}
