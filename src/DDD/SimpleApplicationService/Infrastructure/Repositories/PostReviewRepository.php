<?php

namespace DDD\SimpleApplicationService\Infrastructure\Repositories;

use DDD\SimpleApplicationService\Domain\IStorePostReviewRepository;
use DDD\SimpleApplicationService\Domain\PostReviewCouldNotBeStoredException;
use DDD\SimpleApplicationService\Domain\Review;

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
