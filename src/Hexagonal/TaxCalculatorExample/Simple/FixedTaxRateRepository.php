<?php

namespace Hexagonal\TaxCalculatorExample\Simple;

class FixedTaxRateRepository implements ForGettingTaxRates
{
    public function taxRate(float $amount): float
    {
        return 0.08; // 8% tax rate
    }
}
