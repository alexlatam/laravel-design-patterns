<?php

namespace Testing\Feature\Domain\Tests\ObjectMothers;

use Faker\Factory;
use Testing\Feature\Domain\ValueObjects\UserName;

final class UserNameMother
{
    public static function create(string $name): UserName
    {
        return new UserName($name);
    }

    public static function random(): UserName
    {
        return self::create(Factory::create()->name);
    }
}
