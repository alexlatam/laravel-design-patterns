<?php

namespace Criteria\SearchUsers\Application;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\Users;
use Criteria\Shared\Domain\Criteria\Criteria;

final readonly class SearchUsersUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function execute(Criteria $criteria): Users
    {
        return $this->repository->matching($criteria);
    }
}
