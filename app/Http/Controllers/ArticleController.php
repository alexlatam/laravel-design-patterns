<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __invoke(): Renderable
    {

        $status = request()->query("status"); // Estatus viene de la url, como un query param
        $sort = request()->query("sort"); // Estatus viene de la url, como un query param

        // dd($status, $sort);

        $articles = Article::query()
            ->when($status, fn(Builder $query) => $query->where("status", $status))
            ->when($sort, fn(Builder $query) => $query->orderBy("id", $sort))
            ->paginate()
            ->withQueryString(); // evita que al cambiar de pagina se pierdan los filtros aplicados por los query params

            return view("articles.index", compact("articles"));
    }
}
