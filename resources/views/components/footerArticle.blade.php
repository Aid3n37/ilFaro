<li>
  <a href="{{route('article.show', ['article'=> $item])}}" class="d-flex align-items-center">
      <img src="{{Storage::url($item->image)}}" alt="" class="img-fluid me-3">
      <div>
          <div class="post-meta d-block"><span class="date">{{$item->category->name}}</span> <span
                  class="mx-1">•</span> <span>{{$item->created_at->format('d/m/Y')}}</span></div>
          <span>{{$item->title}}</span>
      </div>
  </a>
</li>