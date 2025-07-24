<?php

namespace DDD\RealExample\User\Domain;

class VerifyUserExists
{
    public function __construct(private readonly UserRepository $userRepository)
    {}

    public function execute(Email $email): bool
    {
        return $this->userRepository->findByEmail($email->value()) !== null;
    }
}
