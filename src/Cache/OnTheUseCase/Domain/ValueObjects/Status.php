<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;

class Status
{
    private int $value;

    /**
     * @throws Exception
     */
    public function __construct(int $value)
    {
        if($value < 0){
            throw new Exception('Status must be positive');
        }
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
