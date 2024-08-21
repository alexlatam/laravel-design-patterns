<?php

namespace CQRS\Products\Application\Find;

use CQRS\Shared\Domain\Bus\Queries\Query;

final class FindProductQuery extends Query
{
    public function __construct(
        private readonly string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}
