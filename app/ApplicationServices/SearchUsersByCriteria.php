<?php

namespace App\ApplicationServices;

use App\Criteria\Criteria;
use App\Criteria\Filters;
use App\Criteria\Order;
use App\DTOs\SearchUsersByCriteriaDto;
use App\Repositories\EloquentUserRepository;

final readonly class SearchUsersByCriteria
{
    public function __construct(private EloquentUserRepository $repository)
    {
    }

    public function __invoke(SearchUsersByCriteriaDto $request): array
    {
        /**
         * Convertimos el array de filtros en un objeto de tipo Filters que contiene una coleccion de Filter
         * Cada Filter es un campo de la tabla que se quiere filtrar. ['field', 'operator', 'value']
         */
        $filters = Filters::fromValues($request->getFilters());

        /**
         * Convertimos el array de ordenamiento en un objeto de tipo Order
         * ['orderBy' => '...', 'order' => '...']
         * OrderBy es el campo por el cual se quiere ordenar. ['id', 'name', 'email', ...]
         * Order es el tipo de ordenamiento [Asc, Desc]
         */
        $order   = Order::fromValues($request->getOrderBy(), $request->getOrder());

        $criteria = new Criteria(
            filters: $filters,
            order: $order,
            offset: $request->getOffset(),
            limit: $request->getLimit()
        );

        return $this->repository->searchByCriteria($criteria);
    }

}
