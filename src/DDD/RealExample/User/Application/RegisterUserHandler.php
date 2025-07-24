<?php

namespace DDD\RealExample\User\Application;

use DDD\RealExample\Shared\Domain\EventDispatcherInterface;
use DDD\RealExample\User\Domain\Command;
use DDD\RealExample\User\Domain\Email;
use DDD\RealExample\User\Domain\EmailAlreadyExistsException;
use DDD\RealExample\User\Domain\User;
use DDD\RealExample\User\Domain\UserRegistered;
use DDD\RealExample\User\Domain\UserRepository;
use DDD\RealExample\User\Domain\VerifyUserExists;
use Exception;

class RegisterUserHandler
{
    public function __construct(
        private readonly UserRepository   $userRepository,
        private readonly VerifyUserExists $verifyUserExists,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
    }

    /**
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $email = new Email($command->email());

        if ($this->verifyUserExists->execute($email)) {
            throw new EmailAlreadyExistsException("The email already exists");
        }

        $user = User::create(
            $command->id(),
            $command->email(),
            $command->password()
        );

        $this->userRepository->save($user);

        // Dispatch the domain event
        $this->eventDispatcher->dispatch(new UserRegistered(
            id: $user->id(),
            email: $user->email(),
        ));
    }
}
