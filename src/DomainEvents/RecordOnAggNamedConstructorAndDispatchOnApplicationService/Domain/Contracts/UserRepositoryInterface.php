<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\User;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserId;

interface UserRepositoryInterface
{
    public function find(UserId $id): ?User;
    public function save(User $user): void;
}
