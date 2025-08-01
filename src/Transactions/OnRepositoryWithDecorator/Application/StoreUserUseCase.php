<?php

namespace Transactions\OnRepositoryWithDecorator\Application;

use Transactions\OnRepositoryWithDecorator\Domain\IUserRepository;
use Transactions\OnRepositoryWithDecorator\Domain\User;

/**
 * This use case has a decorator repository with transaction
 */
final readonly class StoreUserUseCase
{
    public function __construct(private IUserRepository $repository)
    {
    }

    public function execute(StoreUserDto $userDto): void
    {
        $user = User::create(
            id: $userDto->getId(),
            firstname: $userDto->getFirstname(),
            lastname: $userDto->getLastname(),
            email: $userDto->getEmail()
        );

        $this->repository->store($user);
    }
}
