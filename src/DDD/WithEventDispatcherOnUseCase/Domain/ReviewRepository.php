<?php

namespace DDD\WithEventDispatcherOnUseCase\Domain;

interface ReviewRepository
{
    public function update(string $reviewId, string $reviewTitle): void;
}
