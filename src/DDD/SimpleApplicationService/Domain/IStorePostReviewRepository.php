<?php

namespace DDD\SimpleApplicationService\Domain;

interface IStorePostReviewRepository
{
    public function store(Review $review): void;
}
