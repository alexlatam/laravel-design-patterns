<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Application;
// namespace DDD\CommandHandlerHandlerWithCommandHandlerBusWithoutAttachCommandHandlerHandler\Post\Application\CreatePostCommandHandler

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\Command;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\CommandHandlerInterface;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Domain\PostRepository;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Domain\Post;

/**
 * Esto es un CommandHandler: Basicamente es un Servicio de Aplicacion que recibe un comando y ejecuta una accion.
 * En este caso se recibe un Dto con los datos necesarios para crear una Review y se crea la entidad Review y se persiste.
 */
final readonly class CreatePostCommandHandler implements CommandHandlerInterface
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
