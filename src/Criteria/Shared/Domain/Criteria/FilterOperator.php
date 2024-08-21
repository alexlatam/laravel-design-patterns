<?php

declare(strict_types=1);

namespace Criteria\Shared\Domain\Criteria;

enum FilterOperator: string
{
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case MAJOR_EQUAL = '>=';
    case MINOR_EQUAL = '<=';
    case MAJOR = '>';
    case MINOR = '<';
    case DIFFERENT = '<>';
    case LIKE = 'like';
    case NOT_LIKE = 'not like';

    /**
     * Builder Operators for Eloquent [where / orWhere clauses]
     * public $operators = [
     * '=', '<', '>', '<=', '>=', '<>', '!=', '<=>',
     * 'like', 'like binary', 'not like', 'ilike',
     * '&', '|', '^', '<<', '>>', '&~', 'is', 'is not',
     * 'rlike', 'not rlike', 'regexp', 'not regexp',
     * '~', '~*', '!~', '!~*', 'similar to',
     * 'not similar to', 'not ilike', '~~*', '!~~*',
     * ];
     */
}
