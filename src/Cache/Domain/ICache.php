<?php

namespace Cache\Domain;

/**
 * Aunque esto sea una interfaz y por lo tanto estoy desacoplando de infraestructura.
 * El concepto de Cache pertenece a la capa de infraestructura.
 * Esto es un error de diseño.
 *
 * El caso de uso no deberia saber(ni deberia interesarle) que existe una cache.
 */
interface ICache
{
    public function has(string $key): bool;

    public function get(string $key): mixed;

    public function set(string $key, mixed $value, int $duration = 3600): void;
}
