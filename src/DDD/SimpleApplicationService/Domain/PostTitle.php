<?php

namespace DDD\SimpleApplicationService\Domain;

use InvalidArgumentException;

readonly class PostTitle
{
    public function __construct(private string $value)
    {
        if(strlen($value) < 10) {
            throw new InvalidArgumentException('Post title must be at least 10 characters long');
        }

        if(strlen($value) > 255) {
            throw new InvalidArgumentException('Post title must be at most 255 characters long');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
