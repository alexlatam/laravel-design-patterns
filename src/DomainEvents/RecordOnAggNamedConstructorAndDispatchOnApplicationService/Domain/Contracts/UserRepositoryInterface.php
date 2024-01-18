<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
