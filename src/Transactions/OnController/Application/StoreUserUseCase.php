<?php

namespace Transactions\OnController\Application;

use Transactions\OnController\Domain\User;
use Transactions\OnController\Domain\UserRepository;

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
