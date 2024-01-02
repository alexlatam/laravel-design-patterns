<?php

namespace App\CommandHandlers;

/**
 * Commando que se instancia desde un controlador
 */
readonly class PublishArticleCommand
{
    public function __construct(
        private string $user_id,
        private string $article_id
    )
    {
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getArticleId(): string
    {
        return $this->article_id;
    }
}
