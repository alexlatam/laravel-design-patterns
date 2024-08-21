<?php

namespace Transactions\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Transactions\Application\NotifyUserUseCase;
use Transactions\Application\StoreUserDto;
use Transactions\Application\StoreUserUseCase;

final readonly class PostStoreUserWithTransactionController
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
        try {
            DB::beginTransaction();
            $this->storeUserUseCase->execute($dto);
            $this->notifyUserUseCase->execute($dto);
            DB::commit();
            return response()->json(['message' => 'User created'], 201);
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating user'], 500);
        }
    }
}
