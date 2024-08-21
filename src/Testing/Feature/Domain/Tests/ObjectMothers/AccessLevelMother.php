<?php

namespace Testing\Feature\Domain\Tests\ObjectMothers;

use Faker\Factory;
use Testing\Feature\Domain\ValueObjects\AccessLevel;

final class AccessLevelMother
{
    public static function create(int $accessLevel): AccessLevel
    {
        return new AccessLevel($accessLevel);
    }

    public static function random(): AccessLevel
    {
        return self::create(Factory::create()->numberBetween(1, 10));
    }
}

