<?php

namespace App\Criteria\Contracts;

use App\Criteria\Criteria;
use Illuminate\Database\Query\Builder;

interface CriteriaConverterInterface
{
    public function convert(Criteria $criteria): Builder;
}
