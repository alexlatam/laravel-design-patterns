<?php

namespace Transactions\OnControllerWithTwoUseCases\Application;

class AnotherUseCase
{
    public function execute(StoreUserDto $userDto): void
    {
        // save on database the event to notify later the user
    }
}
