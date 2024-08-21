<?php

namespace Hex\Backoffice\Posts\Domain\Contracts;

use Hex\Backoffice\Posts\Domain\PostEntity;

interface PostRepositoryInterface
{
    public function findOrFail(string $id): PostEntity;
}
