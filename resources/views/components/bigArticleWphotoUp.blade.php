<div class="post-entry-1">
  <a href="{{route('article.show', ['article'=> $item])}}"><img src="{{Storage::url($item->image)}}" alt="" class="img-fluid"></a>
  <div class="post-meta">
    @if ($item->category)
    <a href="{{route('article.byCategory', ['category'=> $item->category->id])}}" 
      class="date">{{$item->category->name}}</a> 
    @else
    <span>non categorizzato</span>
    @endif
    <span class="mx-1">•</span> 
    <span>{{$item->created_at->format('d/m/Y')}}</span>
  </div>
  <h2 class="mb-2 category_color"><a href="{{ route('article.show', ['article' => $item]) }}">{{$item->title}}</a></h2>
  <p class="mb-4 d-block">{{$item->subtitle}}</p>
  {{-- CONTROLLO DELLA PRESENZA DI TAG + CICLO --}}
  @if ($tags)
  <p class="small fst-italic text-capitalize tags_color">
    @foreach ($tags as $tag)
    #{{$tag->name}}
    @endforeach
  </p>
  @endif
  <a href="{{route('article.byUser', ['user'=> $item->user->id])}}" class="author mb-3 d-block author_color">{{$item->user->name}}</a>
</div>



