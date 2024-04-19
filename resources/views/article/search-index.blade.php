<x-main>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 aos-init aos-animate" data-aos="fade-up">
                    <h2 class="category-title">Cerca : {{$query}}</h2>
                    <hr>
                    @foreach ($articles as $article)
                        <x-indexArticle :item="$article" />
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-main>
