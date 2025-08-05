<?php

namespace CQRS\Shared\Domain\Bus\Queries;

class QueryResponse
{
    private array $data;

    public function __construct(...$data)
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
