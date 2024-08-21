<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Services;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts\UserRepositoryInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Exceptions\UserDoesNotExist;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\User;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\ValueObjects\UserId;

readonly class UserFinderDomainService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @throws UserDoesNotExist
     */
    public function find(string $id): User
    {
        $user = $this->userRepository->find(new UserId($id));

        if(is_null($user)) {
            throw new UserDoesNotExist('User not found');
        }

        return $user;
    }
}
