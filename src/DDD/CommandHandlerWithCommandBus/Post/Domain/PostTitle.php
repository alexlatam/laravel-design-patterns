<?php

namespace DDD\CommandHandlerWithCommandBus\Post\Domain;

use InvalidArgumentException;

readonly class PostTitle
{
    private const MIN_LENGTH = 10;
    private const MAX_LENGTH = 255;

    public function __construct(private string $value)
    {
        if(strlen($value) < self::MIN_LENGTH) {
            throw new InvalidArgumentException('Post title must be at least 10 characters long');
        }

        if(strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException('Post title must be at most 255 characters long');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
