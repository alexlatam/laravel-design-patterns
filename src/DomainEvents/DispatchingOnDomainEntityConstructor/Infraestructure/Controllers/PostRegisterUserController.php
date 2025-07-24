<?php

namespace DomainEvents\DispatchingOnDomainEntityConstructor\Infraestructure\Controllers;

use DomainEvents\DispatchingOnDomainEntityConstructor\Application\UserRegisterApplicationService;
use DomainEvents\DispatchingOnDomainEntityConstructor\Application\UserRegisterCommand;
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
        $this->useCase->execute(
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
