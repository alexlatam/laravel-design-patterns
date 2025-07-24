<?php

namespace DDD\SimpleApplicationService\Application;

class StorePostReviewDto
{
    public function __construct(
        private readonly string $postId,
        private readonly string $authorId,
        private readonly string $title,
        private readonly string $content
    ) {
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
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
