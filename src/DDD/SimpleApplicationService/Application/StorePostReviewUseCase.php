<?php

namespace DDD\SimpleApplicationService\Application;

use DDD\SimpleApplicationService\Domain\IStorePostReviewRepository;
use DDD\SimpleApplicationService\Domain\Review;

final readonly class StorePostReviewUseCase
{
    public function __construct(private IStorePostReviewRepository $repository)
    {
    }

    public function execute(string $postId, string $authorId, string $title, string $content): void
    {
        $review = Review::create($postId, $authorId, $title, $content);
        $this->repository->store($review);
    }
}
