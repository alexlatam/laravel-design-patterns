<?php

namespace Transactions\OnTheRepository\Application;

use Transactions\OnTheRepository\Domain\User;
use Transactions\OnTheRepository\Domain\UserRepository;

readonly class StoreUserUseCase
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function handle(StoreUserDto $dto): void
    {
        $user = User::create(
            id: $dto->id,
            firstname: $dto->firstname,
            lastname: $dto->lastname,
            email: $dto->email
        );

        $this->repository->store($user);
    }
}
