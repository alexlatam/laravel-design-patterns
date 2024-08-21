<?php
declare(strict_types = 1);

namespace Testing\Feature\Domain\ValueObjects;

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
