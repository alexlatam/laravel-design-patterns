<?php

declare(strict_types=1);

namespace App\Criteria;

final readonly class Filter
{
    public function __construct(
        /**
         * Campo de la tabla que se quiere filtrar
         */
        private FilterField    $field,
        /**
         * Operador de comparacion.
         * [<, >, =, <=, >=, !=, like, not like, in, not in, between, not between, is null, is not null]
         */
        private FilterOperator $operator,
        /**
         * Valor con el cual se quiere filtrar
         */
        private FilterValue    $value
    ) {
    }

    // Metodo que recibe un array con los valores de un filtro y devuelve un objeto Filter
    // Permite crear un objeto Filter a partir de un array de valores [ 'field' => '...', 'operator' => '...', 'value' => '...' ]
    public static function fromValues(array $values): self
    {
        return new self(
            new FilterField($values['field']),
            FilterOperator::from($values['operator']), // $values['operator'] es un string. '='
            new FilterValue($values['value'])
        );
    }

    // Retorna el value oject que representa el campo del filtro
    public function field(): FilterField
    {
        return $this->field;
    }

    // Retorna el value oject que representa el operador del filtro. Mayor que, menor que, igual que, etc.
    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    // Retorna el value oject que representa el valor del filtro
    public function value(): FilterValue
    {
        return $this->value;
    }

    public function serialize(): string
    {
        return sprintf('%s.%s.%s', $this->field->value(), $this->operator->value, $this->value->value());
    }
}
