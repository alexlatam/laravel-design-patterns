<?php

namespace App\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Esta clase abstracta nos permite crear Value Objects a partir de ella
 */
abstract class ValueObject implements Arrayable
{
    abstract public function value();

    // Retornara un objeto de la clase que sea instancianda en su momento
    // Crae una instancia de un Value Object. Evitaremos crear instancias de los VO mediante el constructor
    public static function make(mixed ...$value): static
    {
        return new static(...$value);
    }

    // Metodo que crea una instancia de la clase Value Objects a partir de un valor primitivo
    public static function from(mixed ...$values): static
    {
        return static::make(...$values);
    }

    // Metodo que verifica si dos Value Objects son iguales
    public function equals(ValueObject $valueObject): bool
    {
        return $this->value() === $valueObject->value();
    }

    // Metodo que verifica si dos Value Objects son diferentes
    public function notEquals(ValueObject $valueObject): bool
    {
        return !$this->equals($valueObject);
    }

    public function toArray(): array
    {
        return (array) $this->value();
    }

    public function toString(): string
    {
        return (string) $this->value();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function __set(string $name, mixed $value): never
    {
        throw new \Exception('Los Value Objects son inmutables. No puesden ser modificados');
    }
}
