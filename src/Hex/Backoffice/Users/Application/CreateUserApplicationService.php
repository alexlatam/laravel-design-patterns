<?php

namespace Hex\Backoffice\Users\Application;

use Hex\Backoffice\Users\Domain\Exceptions\UserCreatedAtIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserEmailIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserNameIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserPasswordIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserUuidIsEmptyException;
use Hex\Backoffice\Users\Domain\User as UserEntity;
use Hex\Backoffice\Users\Domain\UserRepositoryInterface;

final readonly class CreateUserApplicationService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @throws UserEmailIsEmptyException
     * @throws UserPasswordIsEmptyException
     * @throws UserCreatedAtIsEmptyException
     * @throws UserNameIsEmptyException
     * @throws UserUuidIsEmptyException
     */
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
