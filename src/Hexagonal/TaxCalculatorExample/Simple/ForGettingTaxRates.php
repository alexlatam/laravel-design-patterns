<?php

namespace Hexagonal\TaxCalculatorExample\Simple;

/**
 * Secondary Port: for retrieving tax rates.
 */
interface ForGettingTaxRates
{
    public function taxRate(float $amount): float;
}
