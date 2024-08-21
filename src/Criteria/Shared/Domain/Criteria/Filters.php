<?php

namespace Criteria\Shared\Domain\Criteria;

use function Lambdish\Phunctional\reduce;

/**
 * Clase que representa una coleccion de objetos Filter
 */
final class Filters extends Collection
{
    /**
     * Metodo que recibe un array de filtros y los convierte en un array de objetos Filter
     */
    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    /**
     * Metodo que retorna una funcion, por eso el callable
     * Esta funcion recibe un array con los valores del filtro y retorna una instancia de Filter
     * La variable $values es un array con los valores del filtro. ['field', 'value', 'operator']
     */
    private static function filterBuilder(): callable
    {
        return fn (array $values): Filter => Filter::fromValues($values);
    }

    /**
     * Metodo que recibe un objeto Filter y lo agrega a la coleccion de filtros
     */
    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

    /*
     * Metodo que retorna el array de los filtros.
     * [Filter, Filter, Filter, ...]
     */
    public function filters(): array
    {
        return $this->items();
    }

    public function serialize(): string
    {
        return reduce(
            static fn (string $accumulate, Filter $filter): string => sprintf('%s^%s', $accumulate, $filter->serialize()),
            $this->items(),
            ''
        );
    }

    // Retorna 'App\Criteria\Filter'
    protected function type(): string
    {
        return Filter::class;
    }
}
