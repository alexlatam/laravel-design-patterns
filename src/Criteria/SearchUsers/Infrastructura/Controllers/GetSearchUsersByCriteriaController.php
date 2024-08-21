<?php

namespace Criteria\SearchUsers\Infrastructura\Controllers;

use Criteria\SearchUsers\Application\SearchUsersUseCase;
use Criteria\Shared\Domain\Criteria\Criteria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class GetSearchUsersByCriteriaController
{
    function __construct(
        private SearchUsersUseCase $useCase
    ) {}

    /**
     * Query Parameters:
     * - filters: array
     * - orderBy: string
     * - order: string
     * - pageSize: int
     * - pageNumber: int
     *  url: /products
     *      ?filters[0][field]=name&filters[0][operator]=like&filters[0][value]=%25product%25
     *      ?filters[1][field]=name&filters[1][operator]=like&filters[1][value]=%25product%25
     *      &orderBy=name
     *      &order=asc
     *      &pageSize=10
     *      &pageNumber=1
     */
    public function __invoke(Request $request): JsonResponse
    {
        // creamos el criteria a partir de los datos que vienen en el request [Query Parameters]
        $criteria = Criteria::fromPrimitives(
            filters: $request->filters,
            orderBy: $request->orderBy,
            order: $request->order,
            pageSize: $request->pageSize,
            pageNumber: $request->pageNumber
        );

        return new JsonResponse(
            $this->useCase->execute($criteria)
        );
    }
}
