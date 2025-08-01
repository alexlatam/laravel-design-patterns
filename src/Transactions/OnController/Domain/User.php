<?php

namespace Transactions\OnController\Domain;

class User
{
    private function __construct(
        public readonly UserId $id,
        public FirstName $firstname,
        public LastName $lastname,
        public Email $email
    )
    {
    }

    public static function create(
        string $id,
        string $firstname,
        string $lastname,
        string $email
    ): self
    {
        return new self(
            id: new UserId($id),
            firstname: new FirstName($firstname),
            lastname: new LastName($lastname),
            email: new Email($email)
        );
    }

    public function id(): string
    {
        return $this->id->value;
    }

    public function firstname(): string
    {
        return $this->firstname->value;
    }

    public function lastname(): string
    {
        return $this->lastname->value;
    }

    public function email(): string
    {
        return $this->email->value;
    }
}
