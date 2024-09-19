<?php

namespace Cache\Domain;

class Product
{
    public function __construct(
        private readonly ProductId $id,
        private readonly ProductTitle $title,
        private readonly ProductPrice $price,
        private readonly Reviews $Reviews,
    ) {
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

    public function getReviews(): Reviews
    {
        return $this->Reviews;
    }

    public function totalReviews(): int
    {
        return $this->Reviews->total();
    }
}
