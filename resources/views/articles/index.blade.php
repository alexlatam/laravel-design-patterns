<div class="container">
    <h1>Articles</h1>
    <div class="row">
        <form action="" method="GET">
            <div class="col">
                <label for="sort">Ordenar</label>
                <select name="sort" id="sort">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>
            <div class="col">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="1">Approved</option>
                    <option value="2">Pending</option>
                    <option value="3">Rejected</option>
                </select>
            </div>
            <div class="col">
                <button type="submit">Filtrar</button>
            </div>
        </form>
    </div>
    <div class="row">
        <ul>
            @foreach ($articles as $article)
                <li>
                    <p>({{ $article->id }}): {{ $article->title }} ({{ $article->status }})</p>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="row">
        {{ $articles->links() }}
    </div>

</div>
