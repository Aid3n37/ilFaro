<div class="table-responsive">
    <table class="table table-stripped table-hover border">
        <thead class="table-dark">
            {{-- creazione delle colonne della tabella --}}
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Sottotitolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Tags</th>
                <th scope="col">Creato il:</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
    
        <tbody>
            {{-- adesso andremo a ciclare tutti quanti i nostri articoli --}}
            @foreach ($articles as $article )
            <tr>
                <th scope="row">{{$article->id}}</th>
                <td>{{$article->title}}</td>
                <td>{{$article->subtitle}}</td>
                {{-- Nel caso in cui il nome della categoria non fosse impostato verrà visualizzato 'non categorizzato' --}}
                <td>{{$article->category->name ?? 'Non Categorizzato'}}</td>
                <td>
                    @foreach ( $article->tags as $tag)
                        {{$tag->name}}
                    @endforeach
                </td>
                {{-- adesso specifichermeo la creazione dell'articolo con il metodo format in modo da formattare la data --}}
                <td>{{$article->created_at->format('d/m/Y')}}</td>
    
                <td class="align-middle">
                    {{-- Qui andremo ad inserire tre bottoni:
                    Il primo per leggere l'articolo;
                    Il secondo per modificarlo;
                    Il terzo per eliminarlo. --}}
                    <div class="d-flex">
                    <div> <a href="{{route('article.show', compact('article'))}}" class="btn button_read rounded-0 me-1">Leggi</a></div>
                   
                    <div><a href="{{route('article.edit', compact ('article'))}}" class="btn button_edit rounded-0 me-1">Modifica</a></div>
                    
    
                    <form action="{{route('article.destroy', compact('article'))}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn button_delete rounded-0">Elimina</button>
                    </form>
                    </div>
    
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
</div>
