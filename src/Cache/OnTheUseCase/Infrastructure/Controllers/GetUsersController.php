<?php

namespace Cache\OnTheUseCase\Infrastructure\Controllers;

use Cache\OnTheUseCase\Application\GetUsersDto;
use Cache\OnTheUseCase\Application\GetUsersWithCacheOnThisUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Cache en el Caso de Uso.
 *
 * Esta cache se administra en el caso de uso, el cual es inyectado en el controlador
 */
final class GetUsersController
{
    public function __construct(private readonly GetUsersWithCacheOnThisUseCase $useCase)
    {
    }

    public function index(Request $request): JsonResponse
    {
        // obtenemos los datos de la petición
        $status = $request->get('status');
        $price = $request->get('price');

        $dto = new GetUsersDto($status, $price);

        $users = $this->useCase->execute($dto);

        return response()->json([
            'data' => $users
        ]);
    }
}
