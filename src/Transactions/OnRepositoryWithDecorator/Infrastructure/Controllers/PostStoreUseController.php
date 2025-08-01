<?php

namespace Transactions\OnRepositoryWithDecorator\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Transactions\OnRepositoryWithDecorator\Application\NotifyUserUseCase;
use Transactions\OnRepositoryWithDecorator\Application\StoreUserDto;
use Transactions\OnRepositoryWithDecorator\Application\StoreUserUseCase;

final readonly class PostStoreUseController
{
    public function __construct(
        private StoreUserUseCase $storeUserUseCase,
        private NotifyUserUseCase $notifyUserUseCase,
    )
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

        $this->storeUserUseCase->execute($dto);
        $this->notifyUserUseCase->execute($dto);

        return response()->json(['message' => 'User created'], 201);
    }
}
