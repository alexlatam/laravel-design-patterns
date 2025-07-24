<?php

namespace DDD\RealExample\User\Infrastructure\Controllers;

use DDD\RealExample\User\Application\RegisterUserCommand;
use DDD\RealExample\User\Application\RegisterUserHandler;
use DDD\RealExample\User\Infrastructure\Requests\RegisterUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

final readonly class PostRegisterUserController
{
    public function __construct(private RegisterUserHandler $commandHandler)
    {
    }

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $command = new RegisterUserCommand(
            id: Uuid::uuid4()->toString(),
            email: $request->input('email'),
            password: $request->input('password')
        );

        try {
            $this->commandHandler->handle($command);
            return response()->json(['message' => 'User registered successfully'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
