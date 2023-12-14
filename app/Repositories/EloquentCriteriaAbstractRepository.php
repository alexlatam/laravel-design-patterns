<?php

namespace App\Repositories;

abstract class EloquentCriteriaAbstractRepository
{
    /**
     * Namaspace of model. For example: 'App\Models\User'
     * App\Models\User::class
     */
    protected string $model;
}
