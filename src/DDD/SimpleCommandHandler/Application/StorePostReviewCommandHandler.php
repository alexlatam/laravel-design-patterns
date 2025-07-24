<?php

namespace DDD\SimpleCommandHandler\Application;

use DDD\SimpleCommandHandler\Domain\IStorePostReviewRepository;
use DDD\SimpleCommandHandler\Domain\Review;

/**
 * Esto es un CommandHandler: BAsicamente es un Servicio de Aplicacion que recibe un comando y ejecuta una accion.
 * En este caso se recibe un Dto con los datos necesarios para crear una Review y se crea la entidad Review y se persiste.
 */
final readonly class StorePostReviewCommandHandler
{
    public function __construct(private IStorePostReviewRepository $repository)
    {
    }

    public function handle(CreatePostReviewCommand $command): void
    {
        $review = Review::create(
            $command->getPostId(),
            $command->getUserId(),
            $command->getTitle(),
            $command->getContent()
        );
        $this->repository->store($review);
    }
}
