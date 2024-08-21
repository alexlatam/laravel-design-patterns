<?php

namespace Transactions\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Transactions\Application\StoreUserDto;
use Transactions\Application\StoreUserUseCase;

final readonly class PostStoreUserController
{
    public function __construct(private StoreUserUseCase $useCase)
    {
    }

    public function __invoke(Request $request):JsonResponse
    {
        $dto = new StoreUserDto(
            id: $request->input('id'),
            firstname: $request->input('firstname'),
            lastname: $request->input('lastname'),
            email: $request->input('email'),
        );
        $this->useCase->execute($dto);
        return response()->json(['message' => 'User created'], 201);
    }
}
