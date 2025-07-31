<?php

namespace Criteria\SearchUsers\Infrastructura\Repositories;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\SearchUsers\Domain\Users;
use Criteria\Shared\Domain\Criteria\Criteria;

class ElasticsearchUserRepository implements UserRepositoryInterface
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function all(): Users
    {
        return new Users();
        // TODO: Implement all() method.
    }

    public function find(UserId $id): User
    {
        return User::create(
            $id->value(),
            'John Doe',
            'john@mail.com'
        );
    }

    public function matching(Criteria $criteria): Users
    {
        return new Users();
        // TODO: Implement matching() method.
    }
}
