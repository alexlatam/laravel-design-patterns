<?php

namespace App\Http\Dtos;

readonly class SearchAdvertisementDto
{
    public function __construct(
        private bool $show_all,
        private string $status,
        private ?float $max_price,
        private ?float $min_price,
        private ?int $category_id,
        private ?string $keyword,
    ) {}

    public function getShowAll(): bool
    {
        return $this->show_all;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function getMaxPrice(): ?float
    {
        return $this->max_price;
    }

    public function getMinPrice(): ?float
    {
        return $this->min_price;
    }
}
