<?php

namespace Testing\Feature\Domain\Tests\ObjectMothers;

use Testing\Feature\Domain\UserEntity;
use Testing\Feature\Domain\ValueObjects\AccessLevel;
use Testing\Feature\Domain\ValueObjects\UserId;
use Testing\Feature\Domain\ValueObjects\UserName;

final class UserEntityMother
{
    public static function create(
        ?UserId $id = null,
        ?UserName $name = null,
        ?AccessLevel $accessLevel = null
    ): UserEntity {
        $id =  $id ?? UserIdMother::random();
        $name =  $name ?? UserNameMother::random();
        $accessLevel = $accessLevel ?? AccessLevelMother::random();

        return new UserEntity(
            id: $id,
            name: $name,
            accessLevel: $accessLevel
        );
    }

    public static function fromPrimitives(
        ?string $id = null,
        ?string $name = null,
        ?int $accessLevel = null
    ): UserEntity {
        $id =  is_null($id) ? UserIdMother::create($id) : UserIdMother::random();
        $name =  is_null($name) ? UserNameMother::create($id) : UserNameMother::random();
        $accessLevel =  is_null($accessLevel) ? AccessLevelMother::create($id) : AccessLevelMother::random();

        return self::create(
            id: $id,
            name: $name,
            accessLevel: $accessLevel,
        );
    }

    public static function random(): UserEntity
    {
        return self::create(UserIdMother::random(), UserNameMother::random(), AccessLevelMother::random());
    }
}
