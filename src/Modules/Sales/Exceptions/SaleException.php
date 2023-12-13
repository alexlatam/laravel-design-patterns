<?php

namespace Modules\Sales\Exceptions;

use Core\Exceptions\ExceptionCodeEnum;
use Core\Exceptions\InternalException;

class SaleException extends InternalException
{
    public static function userAlreadyExists(): self
    {
        return static::new(
            code: ExceptionCodeEnum::SaleAlreadyExists,
        );
    }
}
