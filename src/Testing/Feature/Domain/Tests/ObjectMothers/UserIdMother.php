<?php

namespace Testing\Feature\Domain\Tests\ObjectMothers;

use Faker\Factory;
use Testing\Feature\Domain\ValueObjects\UserId;

final class UserIdMother
{
    public static function create(string $id): UserId
    {
        return new UserId($id);
    }

    public static function random(): UserId
    {
        return self::create(Factory::create()->uuid);
    }
}
