<?php

namespace App\CommandHandlers;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Log;

// Contrato que deben cumplir todos los commandHanlders

class PublishArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private RepositoryInterface $userRepository,
        private RepositoryInterface $postRepository
    ) {
    }

    public function execute(PublishArticleCommand $command)
    {
        $user = $this->userRepository->findOrFail($command->getUserId());
        $article = $this->postRepository->findOrFail($command->getArticleId());

        $article->publish($user);
    }
}

/**
 * Desde el controlador seria:
 * $handler = new PublishArticleCommandHandler($userRepository, $postRepository);
 * $command = new PublishArticleCommand($request->get('user_id'), $request->get('article_id'));
 * $handler->execute($command);
 *
 * Usando el decorador, desde el controlador seria:
 * $handler = new LoggerDecorator(new PublishArticleCommandHandler($userRepository, $postRepository), new Log());
 * $command = new PublishArticleCommand($request->get('user_id'), $request->get('article_id'));
 * $handler->execute($command);
 *
 */



