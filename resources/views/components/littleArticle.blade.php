<div class="post-entry-1">
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
  <h2 class="mb-3"><a href="{{route('article.show', ['article'=> $item])}}">{{$item->title}}</a></h2>
  <a href="{{route('article.byUser', ['user'=> $item->user->id])}}" class="author d-block author_color">{{$item->user->name}}</a>
</div>



