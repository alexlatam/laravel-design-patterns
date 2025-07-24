<?php

namespace DDD\WithEventDispatcherOnUseCase\Infrastructure\Controllers;

use DDD\WithEventDispatcherOnUseCase\Application\UpdateReviewUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PutUpdateReviewController
{
    public function __construct(private readonly UpdateReviewUseCase $updateReviewUseCase)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $reviewId = $request->route('review_id');
        $reviewTitle = $request->get('title');

        $this->updateReviewUseCase->execute($reviewId, $reviewTitle);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
