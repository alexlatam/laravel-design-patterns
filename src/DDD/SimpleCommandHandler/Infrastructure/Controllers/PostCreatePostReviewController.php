<?php

namespace DDD\SimpleCommandHandler\Infrastructure\Controllers;

use DDD\SimpleCommandHandler\Application\CreatePostReviewCommand;
use DDD\SimpleCommandHandler\Application\StorePostReviewCommandHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostCreatePostReviewController
{
    public function __construct(private readonly StorePostReviewCommandHandler $commandHandler)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = new CreatePostReviewCommand(
            $request->get('id'),
            $request->get('user_id'),
            $request->get('title'),
            $request->get('content'),
        );

        try {
            $this->commandHandler->handle($command);

            return response()->json([
                'success' => true
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            // log this exception
            return response()->json([]);
        }
    }
}
