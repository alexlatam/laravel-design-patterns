<?php

namespace Cache\Infrastructure\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Cache en el controlador.
 * Este tipo de cache es en memoria, es decir, los datos se almacenan en la memoria del servidor.
 * Este tipo de cache podria estar englobando a todos los casos de uso que use el Controlador
 *
 * Esta cache se puede colocar en un Middleware
 */
final class GetUsersController
{
    // Propiedad donde se almacenarán los datos cacheados
    private array $cacheData = [];

    public function index(Request $request): JsonResponse
    {
        // obtenemos los datos de la petición
        $status = $request->get('status');
        $price = $request->get('price');

        // Creamos el key de la cache. Este key es un hash con los datos de la petición
        $hashKey = Hash::make($status . $price);

        // Si existe en cache retornamos el valor cacheado
        if(isset($this->cacheData[$hashKey])) {
            return response()->json([
                'data' => $this->cacheData[$hashKey]
            ]);
        }

        // En caso de no existir la key en cache, entonces consultamos a BD
        // Esta peticion podria estar en su propio caso de uso, y de alli en un repositorio
        $users = User::where('status', $status)->where('price', $price)->get();

        // Almacenamos en cache. Se podria agregar un campo de tiempo de expiración para la cache
        $this->cacheData[$hashKey] = $users;

        return response()->json([
            'data' => $this->cacheData[$hashKey]
        ]);
    }

}
