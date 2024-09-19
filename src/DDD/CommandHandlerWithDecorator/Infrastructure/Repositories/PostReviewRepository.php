<?php

namespace DDD\CommandHandlerWithDecorator\Infrastructure\Repositories;

use DDD\CommandHandlerWithDecorator\Domain\IStorePostReviewRepository;
use DDD\CommandHandlerWithDecorator\Domain\PostReviewCouldNotBeStoredException;
use DDD\CommandHandlerWithDecorator\Domain\Review;

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
