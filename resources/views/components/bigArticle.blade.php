<div class="d-lg-flex post-entry-2">
  <a href="{{route('article.show', ['article'=> $item])}}" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
    <img src="{{Storage::url($item->image)}}" alt="" class="img-fluid">
  </a>
  <div>
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
    <h3><a href="{{ route('article.show', ['article' => $item]) }}">{{$item->title}}</a></h3>
    <p>{{$item->subtitle}}</p>
    @if ($tags)
    <p class="small fst-italic text-capitalize tags_color">
        @foreach ($tags as $tag)
            #{{$tag->name}}
        @endforeach
    </p>
    @endif
    <div class="d-flex align-items-center author">
      <div class="name">
        <h3 class="m-0 p-0">
          <a href="{{route('article.byUser', ['user'=> $item->user->id])}}" 
            class="author mb-3 d-block author_color">{{$item->user->name}}
          </a>
        </h3>
              {{-- CONTROLLO DELLA PRESENZA DI TAG + CICLO --}}
      </div>
    </div>
  </div>
</div> 
        
  
