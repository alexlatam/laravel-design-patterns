<?php

namespace DDD\CommandHandlerWithCommandBus\Post\Application;

use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\Command;
use DDD\CommandHandlerWithCommandBus\Shared\Application\Buses\CommandHandlerInterface;
use DDD\CommandHandlerWithCommandBus\Post\Domain\PostRepository;
use DDD\CommandHandlerWithCommandBus\Post\Domain\Post;

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
