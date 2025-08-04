<?php

namespace CQRS\Products\Application\Create;

use CQRS\Shared\Domain\Bus\Commands\Command;

final class CreateProductCommand extends Command
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly float  $price,
        public readonly string $image,
    )
    {
    }
}
