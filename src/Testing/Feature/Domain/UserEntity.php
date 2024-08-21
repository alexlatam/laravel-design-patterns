<?php

declare(strict_types = 1);

namespace Testing\Feature\Domain;

use Testing\Feature\Domain\ValueObjects\AccessLevel;
use Testing\Feature\Domain\ValueObjects\UserId;
use Testing\Feature\Domain\ValueObjects\UserName;

final readonly class UserEntity
{
    private const MIN_LEVEL_TO_EDIT_VIDEOS = 3;

    public function __construct(
        private UserId $id,
        private UserName $name,
        private AccessLevel $accessLevel
    ) {}

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function accessLevel(): AccessLevel
    {
        return $this->accessLevel;
    }

    public function canEditVideos(): bool
    {
        return $this->accessLevel()->value() >= self::MIN_LEVEL_TO_EDIT_VIDEOS;
    }
}
