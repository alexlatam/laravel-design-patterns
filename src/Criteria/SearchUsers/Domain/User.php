<?php

namespace Criteria\SearchUsers\Domain;

class User
{
    private function __construct(
        private UserId $id,
        private string $name,
        private string $email,
    )
    {
    }

    public static function create(
        string $id,
        string $name,
        string $email
    ): self
    {
        return new self(
            new UserId($id),
            $name,
            $email
        );
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function equals(self $anotherUser): bool
    {
        return $this->id->equals(new UserId($anotherUser->id()));
    }
}
