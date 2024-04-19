<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 aos-init aos-animate" data-aos="fade-up">
                <h2 class="category-title">Tutti Gli Articoli</h2>
                <hr>
                
                @foreach($articles as $article)
                    <x-indexArticle :item="$article" :tags="$article->tags" />
                    <hr>
                @endforeach

            </div>
            <div class="col-md-3">
                <div class="aside-block">
                    <h3 class="aside-title pb-3">Filtra Articoli</h3>
                    <div class="container-fluid mt-3">
                        <div class="d-flex input-group w-auto">
                            <input type="search" class="form-control rounded-0" placeholder="Cerca" aria-label="Search"
                                aria-describedby="search-addon" name="search"  wire:model.live='search'/>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section>