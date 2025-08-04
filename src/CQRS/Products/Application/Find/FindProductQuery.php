<?php

namespace CQRS\Products\Application\Find;

use CQRS\Shared\Domain\Bus\Queries\Query;

final class FindProductQuery extends Query
{
    public function __construct(
        public readonly string $id,
    ) {}
}
