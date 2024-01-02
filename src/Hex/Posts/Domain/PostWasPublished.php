<?php

namespace Hex\Posts\Domain;

use DateTimeImmutable;

class PostWasPublished
{
    private int $occurredOn;

    public function __construct(
        private string $userId,
        private string $postId,
        DateTimeImmutable $occurredOn
    ) {
        $this->occurredOn = (new DateTimeImmutable())->getTimestamp();
    }

    public function occurredOn()
    {
        return $this->occurredOn;
    }

    public function getAuthorId(): string
    {
        return $this->userId;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }
}
