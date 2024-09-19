<?php

namespace DDD\CommandHandlerWithDecorator\Domain;

interface IStorePostReviewRepository
{
    public function store(Review $review): void;
}
