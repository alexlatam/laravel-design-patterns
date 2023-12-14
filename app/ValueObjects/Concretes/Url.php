<?php

namespace App\ValueObjects\Concretes;

use App\ValueObjects\Primitives\StringValueObject;
use Illuminate\Support\Stringable;

class Url extends StringValueObject
{
    protected function __construct(string|Stringable $value)
    {
        parent::__construct($value);
    }

    protected function validate(): void
    {
        parent::validate();

        if (!filter_var($this->value(), FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('La url no es valida');
        }
    }

    public function protocol(): string
    {
        return parse_url($this->value(), PHP_URL_SCHEME);
    }

    public function domain(): string
    {
        return parse_url($this->value(), PHP_URL_HOST);
    }

    public function path(): string
    {
        return parse_url($this->value(), PHP_URL_PATH);
    }

    public function query(): string
    {
        return parse_url($this->value(), PHP_URL_QUERY);
    }

    public function fragment(): string
    {
        return parse_url($this->value(), PHP_URL_FRAGMENT);
    }

    public function toArray(): array
    {
        return [
            'protocol' => $this->protocol(),
            'domain' => $this->domain(),
            'path' => $this->path(),
            'query' => $this->query(),
            'fragment' => $this->fragment(),
        ];
    }
}
