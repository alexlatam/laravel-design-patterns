<?php

namespace App\Models;

use App\Casts\Title;
use App\QueryFilters\SortFilter;
use App\QueryFilters\StatusFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "status",
    ];

    protected $casts = [
        "title" => Title::class, // Usando un cast personalizado, en este caso el campo 'title' sera casteado a la clase Title, especificamente retornara un ValueObject de la clase Text
    ];

    public function scopeFiltered(Builder $builder): Builder
    {
        // Con query builder sencillo
        // return $builder
        //     ->when(request()->query("status"), fn(Builder $query) => $query->where("status", request()->query("status"))) // Filtrando por status
        //     ->when(request()->query("sort"), fn(Builder $query) => $query->orderBy("id", request()->query("sort"))); // Ordenando por id

        // Con patron Pipeline
        return app(Pipeline::class) // app() es un helper de Laravel que nos permite acceder a cualquier clase que este registrada en el contenedor de servicios
            // ->via('new_handle_mehod_name') // Si queremos cambiar el nombre del metodo handle() de la clase QueryFilter. Debemos usar este metodo
            ->send($builder) // Enviando el query builder. Esta variable sera pasada como parametro a la funcion handle() de la clase Pipeline. Y cada filtro la recibira como parametro en su funcion handle()
            ->through([
                StatusFilter::class, // Primer filtro
                SortFilter::class, // Segundo filtro
            ])
            ->thenReturn(); // Retornando el query builder
    }
}
