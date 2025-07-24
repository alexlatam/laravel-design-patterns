<?php

namespace App\ValueObjects\Concretes;

use InvalidArgumentException;

class Money
{
    private int $amount;
    private Currency $currency;

    public static function fromMoney(self $aMoney): self
    {
        return new self(
            $aMoney->amount(),
            $aMoney->currency()
        );
    }

    public static function fromCurrency(Currency $aCurrency): self
    {
        return new self(0, $aCurrency);
    }

    public static function fromAmountAndCurrency(
        int $anAmount,
        Currency $aCurrency
    ): self {
        return new self(
            $anAmount,
            $aCurrency
        );
    }

    private function __construct(int $anAmount, Currency $aCurrency)
    {
        $this->setAmount($anAmount);
        $this->setCurrency($aCurrency);
    }

    private function setAmount($anAmount): void
    {
        $this->amount = (int) $anAmount;
    }

    private function setCurrency(Currency $aCurrency): void
    {
        $this->currency = $aCurrency;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function increaseAmountBy(int $anAmount): self
    {
        return new self(
            $this->amount() + $anAmount,
            $this->currency()
        );
    }

    public function isEquals(self $aMoney): bool
    {
        return
            $aMoney->currency()->isEquals($this->currency()) &&
            $aMoney->amount() === $this->amount();
    }

    public function add(self $aMoney): self
    {
        $this->guardSameCurrencies($aMoney);

        return new self(
            $aMoney->amount() + $this->amount(),
            $this->currency()
        );
    }

    private function guardSameCurrencies(self $aMoney): void
    {
        if (!$aMoney->currency()->isEquals($this->currency())) {
            throw new InvalidArgumentException(
                'Currencies do not match'
            );
        }
    }
}
