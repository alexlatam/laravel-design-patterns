<?php

namespace Criteria\SearchUsers\Application;

use Criteria\SearchUsers\Domain\Contracts\ProductsRepositoryInterface;
use Criteria\Shared\Domain\Criteria\Criteria;

final readonly class SearchUsersUseCase
{
    public function __construct(
        private ProductsRepositoryInterface $repository
    ) {
    }

    public function execute(Criteria $criteria): array
    {
        return $this->repository->matching($criteria);
    }
}
