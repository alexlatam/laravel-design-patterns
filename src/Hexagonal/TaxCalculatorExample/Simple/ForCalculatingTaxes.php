<?php

namespace Hexagonal\TaxCalculatorExample\Simple;

/**
 * Primary Port: for calculating taxes.
 */
interface ForCalculatingTaxes
{
    public function taxOn(float $amount): float;
}
