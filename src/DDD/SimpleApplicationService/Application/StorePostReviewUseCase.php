<?php

namespace DDD\SimpleApplicationService\Application;

use DDD\SimpleApplicationService\Domain\IStorePostReviewRepository;
use DDD\SimpleApplicationService\Domain\Review;

final readonly class StorePostReviewUseCase
{
    public function __construct(private IStorePostReviewRepository $repository)
    {
    }

    public function execute(StorePostReviewDto $dto): void
    {
        // Se crea la entidad Post Review y luego se persiste.
        // ES importante crear la entidad, pues alli se validan las reglas de negocio.
        $review = Review::create($dto->getPostId(), $dto->getAuthorId(), $dto->getTitle(), $dto->getContent());
        $this->repository->store($review);
    }
}
