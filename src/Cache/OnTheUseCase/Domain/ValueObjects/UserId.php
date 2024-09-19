<?php

namespace Cache\OnTheUseCase\Domain\ValueObjects;

use Exception;

class UserId
{
    private int $value;

    /**
     * @throws Exception
     */
    public function __construct(int $value)
    {
        if($value < 0){
            throw new Exception('Id must not be zero');
        }
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
