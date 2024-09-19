<?php

namespace Cache\Domain;

interface IUserRepository
{
    public function getUsers(string $status, string $price): Users;
}
