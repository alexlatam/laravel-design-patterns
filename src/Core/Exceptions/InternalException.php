<?php

namespace Core\Exceptions;

use Exception;

class InternalException extends Exception
{
    protected string $description;
    protected ExceptionCodeEnum $internalCode;

    public static function new(
        ExceptionCodeEnum $code,
        ?string $message = null,
        ?string $description = null,
        ?int $statusCode = null,
    ): static
    {
        $exception = new static(
            message: $message ?? $code->getMessage(),
            code: $statusCode ?? $code->getStatusCode(),
        );

        $exception->code = $code;
        $exception->description = $description ?? $code->getDescription();

        return $exception;
    }

    public function getInternalCode(): ExceptionCodeEnum
    {
        return $this->internalCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

}
