<?php

namespace DDD\CommandHandlerWithDecorator\Infrastructure\Controllers;

use DDD\CommandHandlerWithDecorator\Application\CreatePostReviewCommand;
use DDD\CommandHandlerWithDecorator\Infrastructure\Logger\LoggerDecorator;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class PostCreatePostReviewController
{
    public function __construct(
        private LoggerDecorator $loggerDecorator,
    ) {
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
            $this->loggerDecorator->handle($command);
            return response()->json([
                'success' => true
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            // log this exception
            return response()->json([]);
        }
    }
}
