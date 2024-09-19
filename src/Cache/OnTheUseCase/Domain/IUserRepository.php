<?php

namespace Cache\OnTheUseCase\Domain;

use Cache\OnTheUseCase\Domain\ValueObjects\Money;
use Cache\OnTheUseCase\Domain\ValueObjects\Status;

interface IUserRepository
{
    public function getUsers(Status $status, Money $price): Users;
}
