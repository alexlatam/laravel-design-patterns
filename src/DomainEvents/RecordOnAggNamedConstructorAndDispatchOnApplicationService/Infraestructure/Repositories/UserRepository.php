<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Infraestructure\Repositories;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts\UserRepositoryInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\User;

final class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }
}
