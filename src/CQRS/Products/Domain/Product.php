<?php

namespace CQRS\Products\Domain;

use CQRS\Products\Domain\ValueObjects\ProductId;
use CQRS\Products\Domain\ValueObjects\ProductImage;
use CQRS\Products\Domain\ValueObjects\ProductPrice;
use CQRS\Products\Domain\ValueObjects\ProductTitle;

final readonly class Product
{
    private function __construct(
        private ProductId $id,
        private ProductTitle $title,
        private ProductPrice $price,
        private ProductImage $image
    ) {
    }

    public static function create(
        string $id,
        string $title,
        int $price,
        string $image
    ): self {
        return new self(
            new ProductId($id),
            new ProductTitle($title),
            new ProductPrice($price),
            new ProductImage($image)
        );
    }

    public function getId(): ProductId
    {
        return $this->id;
    }

    public function getTitle(): ProductTitle
    {
        return $this->title;
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    public function getImage(): ProductImage
    {
        return $this->image;
    }
}
