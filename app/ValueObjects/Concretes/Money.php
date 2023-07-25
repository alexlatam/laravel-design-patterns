<?php

namespace App\ValueObjects\Concretes;

use App\ValueObjects\Primitives\Number;

class Money extends Number
{
    protected function __construct(int|float $value)
    {
        parent::__construct($value);
    }

    public function cents(): int
    {
        return (int) round($this->value() * 100);
    }

    /**
     * Este metodo retorna el valor formateado en dolares. Ej. $1,000.00
     */
    public function formatted(): string
    {
        return (new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY))->formatCurrency($this->value(), 'USD');
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value(),
            'cents' => $this->cents(),
            'formatted' => $this->formatted(),
        ];
    }
}
