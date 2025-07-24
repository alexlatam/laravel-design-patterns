<?php

namespace Hex\Shared;

class UserRegisterUseCase implements CommandHandler
{
    public function __construct(
        private readonly UserRepository $userRepository
    ){
    }

    public function execute(Command $command): Response
    {
        $user = User::create(
            $command->id(),
            $command->name(),
            $command->email(),
            $command->password()
        );

        $this->userRepository->add($user);

        return new UserResponse(
            $user->id(),
            $user->email()
        );
    }
}
