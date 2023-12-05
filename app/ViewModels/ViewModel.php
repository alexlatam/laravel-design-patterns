<?php

namespace App\ViewModels;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use Reflection;
use ReflectionClass;
use ReflectionMethod;

abstract class ViewModel implements Arrayable
{
    public function toArray(): array
    {
        // Obtiene todos los metodos publicos de la clase actual
        return collect((new ReflectionClass($this))->getMethods())
            // Filtra el metodo constructor y el metodo toArray. Osea no los incluye en el array final
            ->reject(fn (ReflectionMethod $method) => in_array($method->getName(), ['__construct', 'toArray']))
            // Filtra los metodos que no sean publicos. Osea solo incluye los metodos publicos
            ->filter(fn (ReflectionMethod $method) => in_array('public', Reflection::getModifierNames($method->getModifiers())))
            // Mapea los metodos y retorna un array asociativo con el nombre del metodo en snake case y el valor que retorna el metodo
            // Ej. ['form_create_meta_data' => $this->formCreateMetaData()]
            ->mapWithKeys(fn (ReflectionMethod $method) => [Str::snake($method->getName()) => $this->{$method->getName()}()])
            // Retorna el array final
            ->toArray();
    }
}
