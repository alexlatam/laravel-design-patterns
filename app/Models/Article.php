<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function scopeFiltered(Builder $builder): Builder
    {
        return $builder
            ->when(request()->query("status"), fn(Builder $query) => $query->where("status", request()->query("status"))) // Filtrando por status
            ->when(request()->query("sort"), fn(Builder $query) => $query->orderBy("id", request()->query("sort"))); // Ordenando por id
    }
}
