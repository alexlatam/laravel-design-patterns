<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Domain;

class Post
{
    private function __construct(
        private readonly PostId $postId,
        private UserId          $authorId,
        private PostTitle       $title,
        private string          $content,
    ) {
    }

    public static function create(
        string $postId,
        string $authorId,
        string $title,
        string $content,
    ): self
    {
        return new self(
            new PostId($postId),
            new UserId($authorId),
            new PostTitle($title),
            $content
        );
    }

    public function id(): string
    {
        return $this->postId->getValue();
    }

    public function authorId(): string
    {
        return $this->authorId->getValue();
    }

    public function title(): string
    {
        return $this->title->getValue();
    }

    public function content(): string
    {
        return $this->content;
    }

    public function toArray(): array
    {
        return [
            'postId' => $this->id(),
            'authorId' => $this->authorId(),
            'title' => $this->title(),
            'content' => $this->content(),
        ];
    }
}
