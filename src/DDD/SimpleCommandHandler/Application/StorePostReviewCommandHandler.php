<?php

namespace DDD\SimpleCommandHandler\Application;

use DDD\SimpleCommandHandler\Domain\IStorePostReviewRepository;
use DDD\SimpleCommandHandler\Domain\Review;

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
