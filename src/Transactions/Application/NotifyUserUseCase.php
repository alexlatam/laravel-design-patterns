<?php

namespace Transactions\Application;

class NotifyUserUseCase
{
    public function execute(StoreUserDto $userDto): void
    {
        // save on database the event to notify later the user
    }
}
