<?php

namespace App\ValueObjects\Concretes;

use App\ValueObjects\Primitives\Text;
use Illuminate\Support\Stringable;

class Phone extends Text
{
    protected function __construct(string|Stringable $value)
    {
        parent::__construct($value);

        $this->value = str_replace([' ', '-', '(', ')'], '', $value);
    }

    public function countryCode(): string
    {
        return substr($this->value(), 0, 2);
    }

    public function areaCode(): string
    {
        return substr($this->value(), 2, 2);
    }

    public function number(): string
    {
        return substr($this->value(), 4);
    }

    public function toArray(): array
    {
        return [
            'country_code' => $this->countryCode(),
            'area_code' => $this->areaCode(),
            'number' => $this->number(),
        ];
    }

    protected function validate(): void
    {
        parent::validate();

        if (!preg_match('/^[0-9]{11}$/', $this->value())) {
            throw new \InvalidArgumentException('El telefono no es valido');
        }
    }
}
