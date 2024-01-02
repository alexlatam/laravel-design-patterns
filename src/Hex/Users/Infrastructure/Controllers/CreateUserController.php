<?php

namespace Hex\Users\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Hex\Users\Application\CreateUserCommand;
use Hex\Users\Domain\CommandBusInterface;
use Hex\Users\Infrastructure\Request\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class CreateUserController extends Controller
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        $id = Uuid::uuid4()->toString();

        $this->commandBus->dispatch(new CreateUserCommand(
            $id,
            $request->name,
            $request->email,
            $request->password,
            $request->created_at,
            $request->updated_at,
        ));

        return new JsonResponse([
            'success' => 'User created successfully',
        ], ResponseAlias::HTTP_CREATED);
    }
}
