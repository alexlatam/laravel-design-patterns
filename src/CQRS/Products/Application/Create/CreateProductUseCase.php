<?php

namespace CQRS\Products\Application\Create;

use CQRS\Shared\Domain\Bus\Commands\CommandBusInterface;

readonly class CreateProductUseCase
{
    public function __construct(
        protected CommandBusInterface $commandBus
    ) {}

    public function execute(CreateProductCommand $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
