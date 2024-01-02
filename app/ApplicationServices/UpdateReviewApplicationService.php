<?php

namespace App\ApplicationServices;

use App\Entities\Review;
use App\Enums\ReviewEvents;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Exception;

final class UpdateReviewApplicationService
{
    public function __construct(
        private readonly ReviewRepositoryInterface $reviewRepository,
        private $eventDispatcher,
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(int $review_id, array $data = []): Review
    {
        // Se busca la review en la base de datos
        $review = $this->reviewRepository->findOrFail($review_id);
        /**
         * Se actualiza la Entidad[Aggregate] Review.
         * Hacerlo de esta manera garantiza que estamos cumpliendo las restricciones del Dominio
         * Basicamente que la Review se pueda actualizar si cumple con las reglas definidas en la propia entidad.
         */
        $review->update($data);
        // Se persiste la review actualizada en la base de datos
        $this->reviewRepository->save($review);
        /**
         * Se dispara el evento ReviewUpdated.
         * Este evento estara siendo escuchado por los listeners que se hayan registrado.
         * Los Listeners de este evento se registraron en el controller que ejecuta este Application Service.
         */
        $this->eventDispatcher->dispatch(ReviewEvents::ReviewUpdated, new ReviewEvent($review));

        return $review;
    }
}
