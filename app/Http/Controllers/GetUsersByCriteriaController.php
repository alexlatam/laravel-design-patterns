<?php

namespace App\Http\Controllers;

use App\ApplicationServices\SearchUsersByCriteria;
use App\DTOs\SearchUsersByCriteriaDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GetUsersByCriteriaController extends Controller
{
    public function __construct(
        private readonly SearchUsersByCriteria $useCase
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        // Request example:
         $request->merge([
             'filters' => [
                 ['field' => 'age', 'value' => '10', 'operator' => '>'],
                 ['field' => 'email', 'value' => '@', 'operator' => 'like'],
             ],
             'orderBy' => 'name',
             'order' => 'asc',
             'limit' => 20,
             'offset' => 20,
         ]);

        $dto = new SearchUsersByCriteriaDto(
            filters: $request->get('filters', []),
            orderBy: $request->get('orderBy'),
            order: $request->get('order'),
            limit: $request->get('limit'),
            offset: $request->get('offset'),
        );

        $users = $this->useCase->__invoke($dto);

        return response()->json([
            'data' => [
                'users' => $users
            ]
        ]);
    }
}
