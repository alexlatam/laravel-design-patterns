<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;
use InvalidArgumentException;

// Money Pattern
readonly class Money
{
    /**
     * @throws Exception
     */
    public function __construct(
        private int      $amount,
        private Currency $currency,
        private int      $decimals = 2
    ) {
        if ($amount < 0) {
            throw new Exception('Amount must be positive');
        }
    }

    public function amount(): int
    {
        return number_format($this->amount, $this->decimals);
    }

    public function amountWithoutDecimals(): int
    {
        return $this->amount;
    }

    public function isoCode(): string
    {
        return $this->currency->value();
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function decimals(): int
    {
        return $this->decimals;
    }

    /**
     * @throws Exception
     */
    public function add(self $aMoney): self
    {
        $this->validateSameCurrencies($aMoney);

        return new self(
            $this->amount() + $aMoney->amount(),
            $this->currency(),
            $this->decimals()
        );
    }

    /**
     * @throws Exception
     */
    public function subtract(self $aMoney): self
    {
        $this->validateSameCurrencies($aMoney);

        return new self(
            max(0, $this->amount() - $aMoney->amount()),
            $this->currency(),
            $this->decimals()
        );
    }

    /**
     * @param Money $aMoney
     */
    private function validateSameCurrencies(Money $aMoney): void
    {
        if (!$aMoney->currency()->equals($this->currency())) {
            throw new InvalidArgumentException(
                'Currencies do not match'
            );
        }
    }
}
