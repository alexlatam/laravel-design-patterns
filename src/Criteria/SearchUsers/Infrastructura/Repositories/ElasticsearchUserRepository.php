<?php

namespace Criteria\SearchUsers\Infrastructura\Repositories;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\Shared\Domain\Criteria\Criteria;

class ElasticsearchUserRepository implements UserRepositoryInterface
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function find(UserId $id): ?array
    {
        // TODO: Implement find() method.
    }

    public function matching(Criteria $criteria): array
    {
        // TODO: Implement matching() method.
    }
}
