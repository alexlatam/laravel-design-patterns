<?php

namespace App\Repositories;

use App\Criteria\Converters\EloquentCriteriaConverter;
use App\Criteria\Criteria;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

final class EloquentUserRepository extends EloquentCriteriaAbstractRepository implements UserRepositoryInterface
{
    protected string $model = User::class;

    public function all(): array
    {
        return app($this->model)->all()->toArray();
    }

    public function searchByCriteria(Criteria $criteria): array
    {
        $converter = new EloquentCriteriaConverter();

        $converter->setModel($this->model);

        $query = $converter->convert($criteria);

        return $query->get()->toArray();
    }
}
