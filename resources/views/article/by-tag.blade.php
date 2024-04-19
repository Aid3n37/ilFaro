<x-main>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 aos-init aos-animate" data-aos="fade-up">
                    <h2 class="category-title">{{ $tag->name }}</h2>

                    @foreach ($articles as $article)
                        @if ($article->is_accepted)
                            <x-indexArticle :item="$article" :tags="$article->tags"  />
                        @endif  
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</x-main>
