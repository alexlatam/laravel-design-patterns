<?php

namespace App\ValueObjects\Concretes;

use InvalidArgumentException;

class Currency
{
    private string $isoCode;
    // This array could be got from an external dependency like the uuid dependency
    private array $validIsoCodes = [
        'USD',
        'EUR',
        'GBP',
        'JPY',
        'CNY',
    ];

    public static function fromValue(string $anIsoCode): self
    {
        return new self($anIsoCode);
    }

    private function __construct(string $anIsoCode)
    {
        $this->setIsoCode($anIsoCode);
    }

    private function setIsoCode(string $anIsoCode): void
    {
        if (!preg_match('/^[A-Z]{3}$/', $anIsoCode)) {
            throw new InvalidArgumentException(
                sprintf('"%s" is not a valid ISO code', $anIsoCode)
            );
        }

        if (!in_array($anIsoCode, $this->validIsoCodes)) {
            throw new InvalidArgumentException(
                sprintf('"%s" is not a valid ISO code', $anIsoCode)
            );
        }

        $this->isoCode = $anIsoCode;
    }

    public function isoCode(): string
    {
        return $this->isoCode;
    }

    public function isEquals(self $currency): bool
    {
        return $currency->isoCode() === $this->isoCode();
    }
}
