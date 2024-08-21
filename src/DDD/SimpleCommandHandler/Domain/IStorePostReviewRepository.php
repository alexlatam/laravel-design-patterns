<?php

namespace DDD\SimpleCommandHandler\Domain;

interface IStorePostReviewRepository
{
    public function store(Review $review): void;
}
