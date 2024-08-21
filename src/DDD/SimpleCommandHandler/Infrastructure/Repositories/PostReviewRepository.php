<?php

namespace DDD\SimpleCommandHandler\Infrastructure\Repositories;

use DDD\SimpleCommandHandler\Domain\IStorePostReviewRepository;
use DDD\SimpleCommandHandler\Domain\PostReviewCouldNotBeStoredException;
use DDD\SimpleCommandHandler\Domain\Review;

class PostReviewRepository implements IStorePostReviewRepository
{
    /**
     * @throws PostReviewCouldNotBeStoredException
     */
    public function store(Review $review): void
    {
        try {
            // Store review in database
            Review::create(
                $review->getPostId(),
                $review->getAuthorId(),
                $review->getTitle(),
                $review->getContent(),
            );
        } catch (\Exception $e) {
            throw new PostReviewCouldNotBeStoredException();
        }
    }
}
