<?php

namespace DomainEvents\DispatchingOnApplicationServices\Infraestructure\Controllers;

use DomainEvents\DispatchingOnApplicationServices\Application\UserRegisterApplicationService;
use DomainEvents\DispatchingOnApplicationServices\Application\UserRegisterCommand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class PostRegisterUserController
{
    public function __construct(
        private UserRegisterApplicationService $useCase
    ) {

    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->useCase->__invoke(
            new UserRegisterCommand(
                $request->id,
                $request->name,
                $request->email,
                $request->password
            )
        );

        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
