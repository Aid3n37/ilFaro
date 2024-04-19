<div class="table-responsive">
    <table class="table table-stiped table-hover shadow">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Sottotitolo</th>
                <th scope="col">Redattore</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row" class="pt-3">{{ $article->id }}</th>
                    <td class="pt-3">{{ $article->title }}</td>
                    <td class="pt-3">{{ $article->subtitle }}</td>
                    <td class="pt-3">{{ $article->user->name }}</td>
                    <td class="align-middle">
                        {{-- In questo modo andremo a controllare se is_accepted proprietà di $article è Null oppure no --}}
                        @if (is_null($article->is_accepted))
                            {{-- Inseriamo la rotta che ci riporta alla pagina di dettaglio articles.show in modo che 
                            l'utente possa leggere l'articolo --}}
                            <a href="{{ route('article.show', compact('article')) }}" class="btn button_read rounded-0">Leggi</a>
                        @else
                            <form action="{{ route('revisor.undoArticle', compact('article')) }}" method="POST">
                                @csrf
                                <button type="input" class="btn button_delete rounded-0">Riporta in revisione</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

