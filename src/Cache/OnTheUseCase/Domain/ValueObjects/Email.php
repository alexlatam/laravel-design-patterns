<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;

class Email
{
    private string $value;

    /**
     * @throws Exception
     */
    public function __construct(string $value)
    {
        $value = trim($value);
        if(empty($value)){
            throw new Exception('Email must not be empty');
        }

        if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email must in the correct format');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
