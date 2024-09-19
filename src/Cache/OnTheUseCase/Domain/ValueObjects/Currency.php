<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;

class Currency
{
    private string $isoCode;

    /**
     * @throws Exception
     */
    public function __construct(string $isoCode)
    {
        $isoCode = trim($isoCode);
        if(empty($isoCode)){
            throw new Exception('Iso code must not be empty');
        }
        $this->isoCode = $isoCode;
    }

    public function value(): string
    {
        return $this->isoCode;
    }
}
