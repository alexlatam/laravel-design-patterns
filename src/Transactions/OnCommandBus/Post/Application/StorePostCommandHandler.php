<?php

namespace Transactions\OnCommandBus\Post\Application;

use Transactions\OnCommandBus\Shared\Application\Buses\Command;
use Transactions\OnCommandBus\Shared\Application\Buses\CommandHandlerInterface;
use Transactions\OnCommandBus\Post\Domain\PostRepository;
use Transactions\OnCommandBus\Post\Domain\Post;

/**
 * Esto es un CommandHandler: Basicamente es un Servicio de Aplicacion que recibe un comando y ejecuta una accion.
 * En este caso se recibe un Dto con los datos necesarios para crear una Review y se crea la entidad Review y se persiste.
 */
final readonly class StorePostCommandHandler implements CommandHandlerInterface
{
    public function __construct(private PostRepository $repository)
    {
    }

    public function handle(Command $command): void
    {
        $post = Post::create(
            $command->postId,
            $command->userId,
            $command->title,
            $command->content
        );
        $this->repository->store($post);
    }
}
