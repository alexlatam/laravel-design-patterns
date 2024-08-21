<?php

namespace Transactions\Application;

use Transactions\Domain\IUserRepository;
use Transactions\Domain\User;

/**
 * This use case has the transaction on the repository
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
