<?php

namespace Criteria\SearchUsers\Infrastructura\Repositories;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\SearchUsers\Domain\Users;
use Criteria\Shared\Domain\Criteria\Contracts\CriteriaConverterInterface;
use Criteria\Shared\Domain\Criteria\Criteria;
use Illuminate\Support\Facades\DB;

final readonly class MysqlUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private CriteriaConverterInterface $converter
    ) {}

    public function matching(Criteria $criteria): Users
    {
        $query = $this->converter->convert($criteria);

        $dbUsers = DB::select($query);

        if(empty($dbUsers)) {
            return new Users();
        }

        return $this->toEntity($dbUsers);
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function all(): Users
    {
        return new Users();
    }

    public function find(UserId $id): User
    {
        // TODO: Implement find() method.
    }

    private function toEntity(array $dbUsers): Users
    {
    }
}
