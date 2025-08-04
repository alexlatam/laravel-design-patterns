<?php

namespace CQRS\Products\Domain;

use CQRS\Products\Domain\ValueObjects\ProductId;
use CQRS\Products\Domain\ValueObjects\ProductImage;
use CQRS\Products\Domain\ValueObjects\ProductPrice;
use CQRS\Products\Domain\ValueObjects\ProductStatus;
use CQRS\Products\Domain\ValueObjects\ProductTitle;

final class Product
{
    private function __construct(
        private readonly ProductId $id,
        private ProductTitle       $title,
        private ProductPrice       $price,
        private ProductStatus      $status,
        private ?ProductImage      $image,
    )
    {
    }

    public static function create(
        string  $id,
        string  $title,
        float   $price,
        ?string $image
    ): self
    {
        $initialStatus = ProductStatus::AVAILABLE;
        $image = is_null($image) ? null : new ProductImage($image);

        return new self(
            new ProductId($id),
            new ProductTitle($title),
            new ProductPrice($price),
            new ProductStatus($initialStatus),
            $image,
        );
    }

    public static function build(string $id, string $title, float $price, int $status, ?string $image): self
    {
        $image = is_null($image) ? null : new ProductImage($image);

        return new self(
            new ProductId($id),
            new ProductTitle($title),
            new ProductPrice($price),
            new ProductStatus($status),
            $image
        );
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function title(): string
    {
        return $this->title->value();
    }

    public function price(): float
    {
        return $this->price->value();
    }

    public function status(): int
    {
        return $this->status->value();
    }

    public function image(): string
    {
        return $this->image->value();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title->value(),
            'price' => $this->price->value(),
            'status' => $this->status->value(),
            'image' => $this->image?->value(),
        ];
    }
}
