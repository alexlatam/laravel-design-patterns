<?php

namespace DomainEvents\DispatchingOnApplicationServices\Domain;

readonly class User
{
    function __construct(
        private UserId $uuid,
        private UserName $name,
        private UserEmail $email,
        private UserPassword $password,
    ) {}

    public static function create(string $id, string $name, string $email, string $password): self
    {
        return new self(
            uuid: new UserId($id),
            name: new UserName($name),
            email: new UserEmail($email),
            password: new UserPassword($password),
        );
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->uuid->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'password' => $this->password->value(),
        ];
    }
}
