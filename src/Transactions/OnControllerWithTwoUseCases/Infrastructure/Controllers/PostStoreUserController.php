<?php

namespace Transactions\OnControllerWithTwoUseCases\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Transactions\OnControllerWithTwoUseCases\Application\AnotherUseCase;
use Transactions\OnControllerWithTwoUseCases\Application\StoreUserDto;
use Transactions\OnControllerWithTwoUseCases\Application\StoreUserUseCase;

final readonly class PostStoreUserController
{
    public function __construct(
        private StoreUserUseCase $storeUserUseCase,
        private AnotherUseCase   $notifyUserUseCase,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request):JsonResponse
    {
        $dto = new StoreUserDto(
            id: $request->input('id'),
            firstname: $request->input('firstname'),
            lastname: $request->input('lastname'),
            email: $request->input('email'),
        );
        try {
            DB::beginTransaction();
            $this->storeUserUseCase->execute($dto);
            $this->notifyUserUseCase->execute($dto);
            DB::commit();
            return response()->json(['message' => 'User created'], 201);
        }catch (\Exception|\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating user'], 500);
        }
    }
}
