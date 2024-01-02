<?php

namespace Hex\Users\Application;

use Hex\Users\Domain\User as UserEntity;
use Hex\Users\Domain\UserRepositoryInterface;

final readonly class CreateUserApplicationService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = UserEntity::create(
            id: $command->getId(),
            name: $command->getName(),
            email: $command->getEmail(),
            password: $command->getPassword(),
            createdAt: $command->getCreatedAt(),
            updatedAt: $command->getUpdatedAt()
        );
        $this->userRepository->save($user);
    }

}
