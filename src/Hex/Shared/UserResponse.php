<?php

namespace Hex\Shared;

final class UserResponse implements Response
{
    public function __construct(
        private readonly string $id,
        private readonly string $email
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }
}
