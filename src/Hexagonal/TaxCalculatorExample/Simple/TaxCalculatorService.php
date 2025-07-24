<?php

namespace Hexagonal\TaxCalculatorExample\Simple;

class TaxCalculatorService implements ForCalculatingTaxes
{
    public function __construct(private readonly ForGettingTaxRates $taxRateRepository)
    {}

    public function taxOn(float $amount): float
    {
        return $amount * $this->taxRateRepository->taxRate($amount);
    }
}
