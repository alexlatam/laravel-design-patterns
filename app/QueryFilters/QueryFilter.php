<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Reflection;
use ReflectionClass;

abstract class QueryFilter
{
    // the name of the filter
    protected string $name;

    // Esta funcion es la que se encarga de ejecutar la logica de los filtros
    // Ademas asi es como esta definida en la clase Pipeline::class
    // en caso de querer llamarlo de otra manera. Sera necesario usar el metodo via('new_name') en la clase Pipeline::class. Ver el modelo Article::class
    public function handle(Builder $builder, Closure $next): Builder
    {
        // Verificamos si el parametro del filtro esta presente en la url
        if (!request()->query($this->name)) {
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

    // Este metodo contrendra la logica del filtro.
    // Esta logica es propia de cada filtro. Cada filtro tendra su propia logica
    abstract protected function apply(Builder $builder): Builder;

    protected function name(): string
    {
        // get the name of the current class
         return (new ReflectionClass($this))->getShortName();
    }
}
