<?php

namespace CQRS\Products\Application\Create;

use CQRS\Shared\Domain\Bus\Commands\Command;

final class CreateProductCommand extends Command
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly int    $price,
        private readonly string $image,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
