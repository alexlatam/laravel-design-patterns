<?php

namespace CQRS\Products\Infrastructure\Controllers;

use CQRS\Products\Application\Create\CreateProductCommand;
use CQRS\Shared\Domain\Bus\Commands\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class PostCreateProductController
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $this->commandBus->dispatch(new CreateProductCommand(
            $request->input('id') ?? UuidGenerator::generate(),
            $request->input('title'),
            $request->input('price'),
            $request->input('image'),
        ));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
