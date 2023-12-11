<?php

namespace Modules\Sales\ValueObjects;

use InvalidArgumentException;

final class UserId
{
    public function __construct(protected string $user_id)
    {
        if(strlen($this->user_id) < 1) {
            throw new InvalidArgumentException('User id cannot be empty');
        }
    }

    public static function from(string $user_id): self
    {
        return new self($user_id);
    }

    public function toNative(): string
    {
        return $this->user_id;
    }
}
