<footer class="footer mt-auto" id="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">Chi Siamo</h3>
                    <p>Siamo il Faro delle notizie, un'istituzione di fiducia che pone la veridicità al centro della
                        nostra missione giornalistica. Il nostro impegno per l'eleganza e la professionalità ci rende il
                        punto di riferimento sulle notizie, illuminando il mondo con informazioni autentiche e
                        affidabili.</p>
                    <p><a href="{{route('aboutUs')}}" class="footer-link-more">Approfondisci</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigazione</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="{{ route('homepage') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="{{ route('article.index') }}"><i class="bi bi-chevron-right"></i> Articoli</a></li>
                        <li><a href="{{ route('careers') }}"><i class="bi bi-chevron-right"></i> Lavora con Noi</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Categorie</h3>
                    <ul class="footer-links list-unstyled">
                        @foreach ($categories as $category)
                        <li><a href="{{route('article.byCategory', ['category'=> $category->id])}}"><i class="bi bi-chevron-right"></i> {{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h3 class="footer-heading">Post Recenti</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        @foreach ($articles as $article)
                            @if ($article->is_accepted)
                                <x-footerArticle :item="$article"/>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-legal">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright ">
                        © Copyright 2024 <strong><span>Il Faro</span></strong>. Tutti i diritti riservati
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</Footer>
