<?php

namespace Transactions\OnController\Infrastructure;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Transactions\OnController\Application\StoreUserDto;
use Transactions\OnController\Application\StoreUserUseCase;

final readonly class PostStoreUserController
{
    public function __construct(
        private StoreUserUseCase $useCase
    ) {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $dto = new StoreUserDto(
            id: $request->input('id'),
            firstname: $request->input('firstname'),
            lastname: $request->input('lastname'),
            email: $request->input('email'),
        );

        DB::transaction(function () use ($dto) {
            $this->useCase->handle($dto);
        });

        return response()->json(['message' => 'User created'], 201);
    }
}
