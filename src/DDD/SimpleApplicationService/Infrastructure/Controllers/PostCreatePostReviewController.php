<?php

namespace DDD\SimpleApplicationService\Infrastructure\Controllers;

use DDD\SimpleApplicationService\Application\StorePostReviewDto;
use DDD\SimpleApplicationService\Application\StorePostReviewUseCase;
use DDD\SimpleApplicationService\Domain\PostReviewCouldNotBeStoredException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostCreatePostReviewController
{
    public function __construct(private readonly StorePostReviewUseCase $useCase)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $postId = $request->get('id');
        $authorId = $request->get('user_id');
        $title = $request->get('title');
        $content = $request->get('content');

        try {
            $this->useCase->execute($postId, $authorId, $title, $content);

            return response()->json([
                'success' => true
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            // log this exception
            return response()->json([]);
        }
    }
}
