<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Infraestructure\Repositories;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts\UserRepositoryInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\User;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserId;

final class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function find(UserId $id): ?User
    {
        return null;
    }
}
