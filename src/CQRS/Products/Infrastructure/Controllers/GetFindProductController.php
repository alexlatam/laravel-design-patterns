<?php

namespace CQRS\Products\Infrastructure\Controllers;

use CQRS\Products\Application\Find\FindProductQuery;
use CQRS\Shared\Domain\Bus\Queries\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class GetFindProductController
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $product = $this->queryBus->ask(
            new FindProductQuery($request->input('product_id'))
        );

        return response()->json($product->toArray(), Response::HTTP_OK);
    }
}
