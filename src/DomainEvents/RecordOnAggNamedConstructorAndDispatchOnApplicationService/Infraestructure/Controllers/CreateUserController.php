<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Infraestructure\Controllers;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Application\Register\UserRegisterUseCase;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Application\Register\UserRegisterCommand;
use Illuminate\Support\Facades\Request;

readonly class CreateUserController
{
    public function __construct(
        private UserRegisterUseCase $userRegisterApplicationService
    ) {}

    public function __invoke(Request $request): void
    {
        $command = new UserRegisterCommand(
            id: $request->id,
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );

        $this->userRegisterApplicationService->__invoke($command);
    }

}
