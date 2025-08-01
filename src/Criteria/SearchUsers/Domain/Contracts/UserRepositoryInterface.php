<?php

namespace Criteria\SearchUsers\Domain\Contracts;

use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\SearchUsers\Domain\Users;
use Criteria\Shared\Domain\Criteria\Criteria;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function all(): Users;
    public function find(UserId $id): User;
    public function matching(Criteria $criteria): Users;
}
