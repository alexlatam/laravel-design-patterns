<?php

namespace Criteria\Shared\Infrastructure\Converters;

use Criteria\Shared\Domain\Criteria\Contracts\CriteriaConverterInterface;
use Criteria\Shared\Domain\Criteria\Criteria;
use Illuminate\Database\Query\Builder;

final class EloquentCriteriaConverter implements CriteriaConverterInterface
{
    protected Builder $builder;

    public function __construct()
    {
        /**
         * Creo una instancia del Builder de Laravel.
         * Es necesario pasarle una instancia de la conexion a la base de datos.
         */
        $this->builder = new Builder(app('db')->connection());
    }

    public function convert(Criteria $criteria): Builder
    {
        $this->formatQuery($criteria);
        $this->formatSort($criteria);
        $this->formatOffset($criteria);
        $this->formatLimit($criteria);

        return $this->builder;
    }

    public function setModel(string $model): void
    {
        $this->builder->from(app($model)->getTable());
    }

    private function formatQuery(Criteria $criteria): void
    {
        if ($criteria->hasFilters()) {
            foreach ($criteria->filters() as $filter) {
                match ($filter->operator()->value) {
                    'like' => $this->builder->where($filter->field()->value(), $filter->operator()->value, "%{$filter->value()->value()}%"),
                    default => $this->builder->where($filter->field()->value(), $filter->operator()->value, $filter->value()->value()),
                };
            }
        }
    }

    private function formatSort(Criteria $criteria): void
    {
        if ($criteria->hasOrder()) {
            $order = $criteria->order();

            $this->builder->orderBy($order->orderBy()->value(), $order->orderType()->value);
        }

    }

    private function formatLimit(Criteria $criteria): void
    {
        if ($criteria->hasLimit()) {
            $this->builder->limit($criteria->limit());
        }
    }

    private function formatOffset(Criteria $criteria): void
    {
        if ($criteria->hasOffset()) {
            $this->builder->offset($criteria->offset());
        }
    }
}
