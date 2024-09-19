<?php

namespace Cache\OnTheUseCase\Domain;

use Cache\OnTheUseCase\Domain\ValueObjects\Currency;
use Cache\OnTheUseCase\Domain\ValueObjects\Email;
use Cache\OnTheUseCase\Domain\ValueObjects\Name;
use Cache\OnTheUseCase\Domain\ValueObjects\Money;
use Cache\OnTheUseCase\Domain\ValueObjects\Status;
use Cache\OnTheUseCase\Domain\ValueObjects\UserId;
use Exception;

class User
{
    private function __construct(
        private readonly UserId $id,
        private Name            $name,
        private Email           $email,
        private Status          $status,
        private Money           $price
    ) {
    }

    /**
     * @throws Exception
     */
    public static function create(
        int    $id,
        string $name,
        string $email,
        string $status,
        int $amount,
        string $isoCode,
    ): User
    {
        return new self(
            new UserId($id),
            new Name($name),
            new Email($email),
            new Status($status),
            new Money($amount, new Currency($isoCode)),
        );
    }

    public function getId(): int
    {
        return $this->id->value();
    }

    public function getName(): string
    {
        return $this->name->value();
    }

    public function getEmail(): string
    {
        return $this->email->value();
    }

    public function getStatus(): string
    {
        return $this->status->value();
    }

    public function getPrice(): Money
    {
        return $this->price;
    }
}
