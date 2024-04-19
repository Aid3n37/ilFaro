<x-main>

 <section class="category-section">
  <div class="container aos-init aos-animate" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-4">
      <h2>Ultimi Articoli</h2>
      <div><a href="{{route('article.index')}}" class="more">Vedi tutti gli articoli</a></div>
    </div>

    <div class="row">
      <div class="col-md-9">
        @foreach ($articles as $article)
          @if ($loop->first)
           <x-bigArticle :item="$article" :tags="$article->tags"/>
          @endif
        @endforeach
        <div class="row">
          <div class="col-lg-4">
            @foreach ($articles as $article )
              @if ($loop->index == 2)
                <x-littleArticleWphoto :item="$article" :tags="$article->tags"/>
              @endif
            @endforeach
            @foreach ($articles as $article)
              @if ($loop->index == 3)
               <x-littleArticle :item="$article" :tags="$article->tags"/>
               @endif
            @endforeach
          </div>
          <div class="col-lg-8">
            @foreach ($articles as $article)
              @if ($loop->index == 1)
                <x-bigArticleWphotoUp :item="$article" :tags="$article->tags"/>
              @endif
            @endforeach
          </div>


        </div>
      </div>

      <div class="col-md-3">
        @foreach ($articles as $article)
          @if ($loop->index > 3)
            <x-littleArticle :item="$article" :tags="$article->tags"/>
          @endif 
        @endforeach
      </div>

    </div>
  </div>
 </section>



</x-main>