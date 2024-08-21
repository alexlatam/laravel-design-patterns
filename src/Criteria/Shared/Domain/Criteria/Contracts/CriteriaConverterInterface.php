<?php


namespace Criteria\Shared\Domain\Criteria\Contracts;

use Criteria\Shared\Domain\Criteria\Criteria;

interface CriteriaConverterInterface
{
    public function convert(Criteria $criteria): mixed;
}
