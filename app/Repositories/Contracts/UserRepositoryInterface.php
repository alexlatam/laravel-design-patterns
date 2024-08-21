<?php

namespace App\Repositories\Contracts;

use Criteria\Criteria;

interface UserRepositoryInterface
{
    public function all(): array;

    public function searchByCriteria(Criteria $criteria): array;
}
