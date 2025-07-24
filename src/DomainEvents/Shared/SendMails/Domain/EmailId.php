<?php

namespace DomainEvents\Shared\SendMails\Domain;

readonly class EmailId
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
