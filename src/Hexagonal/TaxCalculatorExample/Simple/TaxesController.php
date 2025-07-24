<?php

namespace Hexagonal\TaxCalculatorExample\Simple;

class TaxesController
{
    public function __invoke(): void
    {
        $repository = new FixedTaxRateRepository();
        $service = new TaxCalculatorService($repository);
        echo "Tax on $100 is: " . $service->taxOn(100);
    }
}
