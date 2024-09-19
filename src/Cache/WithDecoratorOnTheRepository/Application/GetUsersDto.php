<?php

namespace Cache\WithDecoratorOnTheRepository\Application;

final readonly class GetUsersDto
{
    public function __construct(
        private string $status,
        private string $price,
    ) {
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}
