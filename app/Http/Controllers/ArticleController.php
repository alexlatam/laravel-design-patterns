<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Support\Renderable;

final class ArticleController extends Controller
{
    public function __invoke(): Renderable
    {
        $articles = Article::filtered()
            ->paginate()
            ->withQueryString(); // evita que al cambiar de pagina se pierdan los filtros aplicados por los query params

            return view("articles.index", compact("articles"));
    }
}
