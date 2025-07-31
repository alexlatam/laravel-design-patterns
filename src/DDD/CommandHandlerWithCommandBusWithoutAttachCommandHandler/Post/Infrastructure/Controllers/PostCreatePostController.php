<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Infrastructure\Controllers;

use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Shared\Application\Buses\CommandBusInterface;
use DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Application\CreatePostCommand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class PostCreatePostController
{
    public function __construct(
        private CommandBusInterface $commandBus,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = new CreatePostCommand(
            $request->get('id'),
            $request->get('user_id'),
            $request->get('title'),
            $request->get('content'),
        );

        $this->commandBus->dispatch($command);

        return response()->json(['success' => true], Response::HTTP_CREATED);
    }
}
