<?php

namespace Hex\Shared;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserRegisterController
{
    public function __construct(
        private readonly UserRegisterUseCase $useCase
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $dto = new UserDto(
            $request->input('id'),
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );

        $response = $this->useCase->execute($dto);

        return response()->json("User: ".$response->email()." created", 201);
    }
}
