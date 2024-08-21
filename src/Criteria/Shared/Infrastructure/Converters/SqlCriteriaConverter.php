<?php

namespace Criteria\Shared\Infrastructure\Converters;

use Criteria\Shared\Domain\Criteria\Contracts\CriteriaConverterInterface;
use Criteria\Shared\Domain\Criteria\Criteria;

final readonly class SqlCriteriaConverter implements CriteriaConverterInterface
{
    function __construct(private string $table, private array $fieldsToSelect = [])
    {
    }

    /**
     * Metodo que convierte un Criteria en una consulta SQL
     * Este metodo debe pertenecer a Infraestructura.
     */
    public function convert(Criteria $criteria): string
    {
        $fields = count($this->fieldsToSelect) === 0 ? '*' : implode(', ', $this->fieldsToSelect);
        $query = "SELECT $fields FROM {$this->table}";

		if ($criteria->hasFilters()) {
            $query .= " WHERE ";

            $whereQuery = [];
            foreach ($criteria->filters() as $filter) {
                $whereQuery[] = "{$filter->field->value} {$filter->operator->value} '{$filter->value->value}'";
            }

			$query = $query . implode(" AND ", $whereQuery);
		}

        if ($criteria->hasOrder()) {
            $query .= sprintf(" ORDER BY %s %s", $criteria->order()->orderBy()->value(), $criteria->order()->orderType()->value);
        }

        if (!is_null($criteria->pageSize())) {
            $query .= sprintf(" LIMIT %s", $criteria->pageSize());
        }

        if (!is_null($criteria->pageSize()) && is_null($criteria->pageNumber())) {
            $query .= sprintf(" OFFSET %d", $criteria->pageSize() * ($criteria->pageNumber() - 1));
        }

		return $query;
	}
}
