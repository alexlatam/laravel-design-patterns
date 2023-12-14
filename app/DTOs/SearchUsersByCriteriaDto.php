<?php

namespace App\DTOs;

final readonly class SearchUsersByCriteriaDto
{
    public function __construct(
        private array $filters,
        private ?string $orderBy,
        private ?string $order,
        private ?int $limit,
        private ?int $offset,
    ) {
    }

    /**
     * Array de filtros. Contiene un array de arrays, donde cada array es un filtro
     * Cada filtro se expresa en el formto: ['field', 'operator', 'value']
     * [
     *  ['field' => 'age', 'operator' => '>', 'value' => 18],
     *  ['field' => 'name', 'operator' => '=', 'value' => 'alex'],
     *  ['field' => 'rol', 'operator' => '=', 'value' => 'administrator'],
     * ]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * Campo de la base de datos por el cual se quiere ordenar. ['id', 'name', 'email', ...]
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * Tipo de ordenamiento. [Asc, Desc]
     *
     * En combinacion con el campo orderBy, quedaria asi:
     * -- orderBy = 'id', order = 'Asc' => Ordena por id de forma ascendente
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * Numero de registros a obtener. [10, 20, 30, 40, ...]
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Numero de registros a partir de los cuales empezar a obtener registros. [0, 10, 20, 30, ...]
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

}
