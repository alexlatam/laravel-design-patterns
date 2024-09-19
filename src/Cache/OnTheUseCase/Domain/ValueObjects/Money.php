<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;

// Money Pattern
class Money
{
    private int $amount;
    private int $decimals;
    private Currency $currency;

    /**
     * @throws Exception
     */
    public function __construct(int $amount, Currency $currency, int $decimals = 2)
    {
        if($amount < 0){
            throw new Exception('Amount must be positive');
        }
        $this->amount = $amount;
        $this->currency = $currency;
        $this->decimals = $decimals;
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
}
