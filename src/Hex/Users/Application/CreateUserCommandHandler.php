<?php

namespace Hex\Users\Application;

final readonly class CreateUserCommandHandler
{
    public function __construct(
        private CreateUserApplicationService $applicationService
    ) {
    }

    public function handle(CreateUserCommand $command): void
    {
        $this->applicationService->__invoke($command);
    }
}
