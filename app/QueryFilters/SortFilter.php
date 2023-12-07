<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

final class SortFilter extends QueryFilter
{
    protected string $name = "sort";

    protected function apply(Builder $builder): Builder
    {
        return $builder->orderBy("id", request()->query($this->name));
    }
}
