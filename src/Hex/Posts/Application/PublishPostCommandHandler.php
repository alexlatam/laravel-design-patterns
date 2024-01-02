<?php

namespace Hex\Posts\Application;

use Hex\Posts\Application\Commands\PublishArticleCommand;
use Hex\Posts\Domain\Contracts\PostRepositoryInterface;
use Hex\Posts\Domain\Contracts\UserRepositoryInterface;
use Hex\Posts\Domain\PostEntity;

/*
 * El Command Hanlder es quien se encarga de ejecutar los comandos
 * Mas especificamente los casos de uso.
 * Este Command Handler es llamado desde el controlador de la API.
 * -- Mas especificamente desde el Command Bus.
 * El Command Bus es quien se encarga de llamar al Command Handler.
 * -- Esto lo hace mediante un mapper interno que mapea el Comando con el Command Handler.
 */
readonly class PublishPostCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function execute(PublishArticleCommand $command): PostEntity
    {
        $user = $this->userRepository->findOrFail($command->getAuthorId());
        $post = $this->postRepository->findOrFail($command->getPostId());

        $post->publish($user);

        /**
         * More tasks after publish post...
         * Send emails to author when post is published
         * Add new post to elasticsearck index for search
         * ...
         */

        return $post;
    }
}
