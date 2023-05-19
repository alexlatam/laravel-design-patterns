<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

final class StatusFilter extends QueryFilter
{
    // Esta funcion es la que se encarga de la logica que aplicara este filtro
    // Recibe como parametro el query builder y retorna el query builder modificado
    // Este builder que recibe, viene procesado de los filtros anteriores
    protected function apply(Builder $builder): Builder
    {
        // El valor del campo status que se envia en la peticion (url - request)
        $value = request()->query($this->filterName());
        // Aqui estamos filtrando por status
        return $builder->where("status", $value);
    }

    // El nombre del filtro debe ser igual al nombre del parametro que se envia en la url
    // En este caso el parametro que se envia en la url(o request) es 'status'
    protected function filterName(): string
    {
        return "status";
    }
}
