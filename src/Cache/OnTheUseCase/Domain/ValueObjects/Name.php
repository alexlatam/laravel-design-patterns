<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;

class Name
{
    private string $value;

    /**
     * @throws Exception
     */
    public function __construct(string $value)
    {
        $value = trim($value);
        if(empty($value)){
            throw new Exception('Name must not be empty');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
