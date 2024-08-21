<?php

namespace Criteria\SearchUsers\Domain\Contracts;

use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\Shared\Domain\Criteria\Criteria;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function all(): array;
    public function find(UserId $id): ?array;
    public function matching(Criteria $criteria): array;
}
