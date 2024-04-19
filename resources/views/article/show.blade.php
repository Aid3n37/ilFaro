<x-main>
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content aos-init aos-animate" data-aos="fade-up">
                    
                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta">
                            <a href="{{route('article.byCategory', ['category'=> $article->category->id])}}" class="date">{{$article->category->name}}</a>
                            <span class="mx-1">•</span> 
                            <span>{{$article->created_at->format('d/m/Y')}}</span><span class="mx-1">•</span>
                            <span><a href="{{route('article.byUser', ['user'=> $article->user->id])}}" class="date author_color">{{$article->user->name}}</a></span>
                        </div>
                        <h1 class="mb-5">{{ $article->title }}</h1>
                        <p><span>{{ $article->subtitle }}</span></p>

                        
                        <figure class="my-4 ms-5 ">
                            <img src="{{ Storage::url($article->image) }}" alt="" class="w-75 h-auto ms-5 ps-4">
                        </figure>
                        <p>{{ $article->body }}</p>
                        
                    </div>
                    <div class="btn-group mt-5">
                        {{-- Se l'utente è loggato e se questo utente è anche revisore allora lui potrà vedere i seguenti bottoni --}}
                        {{-- Logica di revisione degli articoli --}}
                        {{-- In questo modo i pulsanti 'Accetta Articolo' e 'Rifiuta Articolo' saranno visibili solamente
                        se l'utente è un revisore se l'utente è autenticato e se l'articolo non è stato ancora accettato; 
                        Nel caso in cui l'articolo fosse già stato accettato per merito di !$article->is_accepted i due bottoni verrano nascosti  --}}
                        @if (Auth::user() && Auth::user()->is_revisor && !$article->is_accepted)
                        <form action="{{ route('revisor.acceptArticle', compact('article')) }}" method="POST">
                            @csrf
                            <button type="input" class="btn button_edit rounded-0 me-5 rounded-0">Accetta
                                Articolo</button>
                        </form>
                            
                        <form action="{{ route('revisor.rejectArticle', compact('article')) }}" method="POST">
                            @csrf
                            <button type="input" class="btn button_delete rounded-0 rounded-0">Rifiuta
                                Articolo</button>
                        </form>
                        @endif

                    </div>
                    <div class="btn-group mt-5">
                        @if (Auth::user() && Auth::user()->is_writer && Auth::user()->name == $article->user->name)
                            <a href="{{route('article.edit', compact ('article'))}}" class="btn button_edit rounded-0 mr-5 ">Modifica articolo</a>

                            <form action="{{route('article.destroy', compact('article'))}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn button_delete rounded-0 mx-5">Elimina Articolo</button>
                            </form>
                            @endif
                        </div><!-- End Single Post Content -->
                    </div>

                {{-- controllo tag --> da revisionare --}}

                        <div class="col-md-3 position-relative ">
                            <div class="aside-block">
                                <h3 class="aside-title">Categorie</h3>
                                <ul class="aside-links list-unstyled">
                                    @foreach ($categories as $category )
                                        <li><a href="{{route('article.byCategory', ['category'=> $category->id])}}"><i class="bi bi-chevron-right"></i> {{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="aside-block z-3 position-absolute ">
                                <h3 class="aside-title">Tags</h3>
                                <ul class="aside-tags list-unstyled">
                                    @foreach ($article->tags as $tag)
                                    <li><a href="{{route('article.byTag', ['tag'=> $tag->id])}}">{{$tag->name}}</a></li>
                                @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            
        </x-main>
        