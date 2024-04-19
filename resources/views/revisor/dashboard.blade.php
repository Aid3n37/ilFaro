<x-main>
    <section class="contact mb-5">
        <div class="pt-5 pb-3">
            <h1 class="page-title text-center">
                Bentornato Revisore
            </h1>
        </div>
        <div class="container-fluid position-relative">
            @if (session('message'))
                <div
                    class="alert alert-success alert-dismissible fade show pt-3 w-25 text-center position-absolute top-50 start-50 translate-middle m-3">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3 class="">Articoli Da Revisionare</h3>
                    {{-- tabella per le richieste di amministratore --}}
                    <x-articles-table :articles="$unrevisionedArticles" />
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3>Articoli Pubblicati</h3>
                    {{-- tabella per le richieste di revisore --}}
                    <x-articles-table :articles="$acceptedArticles" />
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3>Articoli Respinti</h3>
                    {{-- tabella per le richieste di redattore --}}
                    <x-articles-table :articles="$rejectedArticles" />
                </div>
            </div>
        </div>
    </section>
</x-main>
