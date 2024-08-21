<?php

namespace Criteria\SearchUsers\Infrastructura\Repositories;

use Criteria\SearchUsers\Domain\Contracts\UserRepositoryInterface;
use Criteria\SearchUsers\Domain\User;
use Criteria\SearchUsers\Domain\UserId;
use Criteria\Shared\Domain\Criteria\Contracts\CriteriaConverterInterface;
use Criteria\Shared\Domain\Criteria\Criteria;
use Criteria\Shared\Infrastructure\Databases\MysqlConnection;

final readonly class MysqlUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private CriteriaConverterInterface $converter,
        private MysqlConnection            $connection
    ) {}

    public function matching(Criteria $criteria): array
    {
        $query = $this->converter->convert($criteria);

        return $this->connection->get($query);
    }

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
}
