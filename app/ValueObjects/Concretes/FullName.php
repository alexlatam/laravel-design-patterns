<?php

namespace App\ValueObjects\Concretes;

use App\ValueObjects\Primitives\Text;
use Illuminate\Support\Stringable;

class FullName extends Text
{
    protected function __construct(string|Stringable $value)
    {
        parent::__construct($value);

        $this->value = ucwords($value);
    }

    public function firstName(): string
    {
        return implode(' ', array_slice(explode(' ', $this->value()), 0, -2))[0];
    }

    public function lastName(): string
    {
        return implode(' ', array_slice(explode(' ', $this->value()), -2));
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName(),
            'last_name' => $this->lastName(),
        ];
    }
}
