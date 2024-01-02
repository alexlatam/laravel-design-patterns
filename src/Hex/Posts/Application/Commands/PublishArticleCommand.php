<?php

namespace Hex\Posts\Application\Commands;

readonly class PublishArticleCommand
{
    public function __construct(
        private string $userId,
        private string $postId
    ) {
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
