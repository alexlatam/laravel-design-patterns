<?php

namespace Hex\Posts\Domain\Contracts;

use Hex\Posts\Domain\PostEntity;

interface PostRepositoryInterface
{
    public function findOrFail(string $id): PostEntity;
}
