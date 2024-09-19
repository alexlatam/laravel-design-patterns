<?php

namespace DDD\CommandHandlerWithDecorator\Application;

readonly class CreatePostReviewCommand
{
    public function __construct(
        private string $userId,
        private string $postId,
        private string $title,
        private string $content
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
