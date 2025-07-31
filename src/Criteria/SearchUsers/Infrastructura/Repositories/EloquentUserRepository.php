<?php

namespace Criteria\SearchUsers\Infrastructura\Repositories;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\SearchUsers\Domain\Users;
use Criteria\Shared\Domain\Criteria\Criteria;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function all(): Users
    {
        return new Users();
    }

    public function matching(Criteria $criteria): Users
    {
        return new Users();
    }

    public function save(User $user): void
    {
    }

    public function find(UserId $id): User
    {
        return User::create(
            $id->value(),
            'John Doe',
            'john@mail.com'
        );
    }
}
