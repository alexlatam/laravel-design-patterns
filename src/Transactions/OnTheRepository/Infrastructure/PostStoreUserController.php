<?php

namespace Transactions\OnTheRepository\Infrastructure;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Transactions\OnTheRepository\Application\StoreUserDto;
use Transactions\OnTheRepository\Application\StoreUserUseCase;

final readonly class PostStoreUserController
{
    public function __construct(
        private StoreUserUseCase $useCase
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $dto = new StoreUserDto(
            id: $request->input('id'),
            firstname: $request->input('firstname'),
            lastname: $request->input('lastname'),
            email: $request->input('email'),
        );
        $this->useCase->handle($dto);

        return response()->json(['message' => 'User created'], 201);
    }
}
