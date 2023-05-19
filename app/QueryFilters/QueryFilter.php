<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    // Esta funcion debe llamarse asi, ya que es la que se encarga de ejecutar la logica de los filtros
    // Ademas asi es como esta definida en la clase Pipeline::class
    // en caso de querer llamarlo de otra manera. Sera necesario usar el metodo via('new_name') en la clase Pipeline::class. Ver el modelo Article::class
    public function handle(Builder $builder, Closure $next): Builder
    {
        // Verificamos si el parametro del filtro esta presente en la url
        if (!request()->query($this->filterName())) {
            // Pasamos el builder al siguiente filtro
            return $next($builder);
        }

        // Ejecutamos el metodo apply sobre el builder
        // Este metodo es el que se encarga de aplicar la logica del filtro
        // El builder que recibe, viene procesado de los filtros anteriores
        // Este builder es retornado ya con el flitro aplicado
        $builder = $this->apply($builder);

        // Pasamos el builder al siguiente filtro
        return $next($builder);
    }

    // Este emtodo contrendra la logica del filtro
    abstract protected function apply(Builder $builder): Builder;
    // En este metodo definimos el parametro que se envia en la url(osea el parametro que el filtro usara para filtrar)
    abstract protected function filterName(): string;
}
