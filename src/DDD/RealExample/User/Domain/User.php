<?php

namespace DDD\RealExample\User\Domain;

class User
{
    private function __construct(
        private readonly Uuid $id,
        private Email $email,
        private Password $password
    ) {
    }

    public static function create(
        string $id,
        string $email,
        string $password
    ): self {
        return new self(
            new Uuid($id),
            new Email($email),
            new Password($password)
        );
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }
}
