<?php

namespace Criteria\SearchUsers\Infrastructura\Repositories;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\Shared\Domain\Criteria\Criteria;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function all(): array
    {
        return [];
    }

    public function matching(Criteria $criteria): array
    {
        return [];
    }

    public function save(User $user): void
    {
    }

    public function find(UserId $id): ?array
    {
        return [];
    }
}
