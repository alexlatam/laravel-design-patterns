<?php

namespace Core\Exceptions;

enum ExceptionCodeEnum: int
{
    case NoSubscription = 10_000;
    case NoPaymentMethod = 10_001;
    case NoCustomer = 10_002;
    case NoPlan = 10_003;

    case SaleAlreadyExists = 11_000;

    case NoAccess = 90_000;

    public function getStatusCode(): int
    {
        $value = $this->value;

        return match (true) {
            $value >= 10_004 => 403,
            $value >= 90_000 => 403,
            $value >= 10_000 => 400,
            default => 500,
        };
    }

    public function getMessage(): string
    {
        $key = "exceptions.{$this->value}.message";
        $translation = __($key);

        if($translation === $key) {
            return 'Something bad happened';
        }

        return $translation;
    }

    public function getDescription(): string
    {
        $key = "exceptions.{$this->value}.description";
        $translation = __($key);

        if($translation === $key) {
            return 'Not additional description provided';
        }

        return $translation;
    }

    public function getLink(): string
    {
        return route('docs.exceptions', [
            'code' => $this->value,
        ]);
    }
}
