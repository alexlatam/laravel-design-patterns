<?php

namespace DDD\CommandHandlerWithDecorator\Application;

use DDD\CommandHandlerWithDecorator\Domain\IStorePostReviewRepository;
use DDD\CommandHandlerWithDecorator\Domain\Review;

final readonly class StorePostReviewCommandHandler
{
    public function __construct(private IStorePostReviewRepository $repository)
    {
    }

    public function handle(CreatePostReviewCommand $command): void
    {
        $review = Review::create(
            $command->getPostId(),
            $command->getUserId(),
            $command->getTitle(),
            $command->getContent()
        );
        $this->repository->store($review);
    }
}
