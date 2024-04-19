<x-main>
    <div>
        <section class="contact" id="contact">
            <div class="container my-5 p-5">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mb-5">
                        <h1 class="page-title text-center">
                            Richieste Ruoli
                        </h1>
                        <div class="container-fluid position-relative">
                            @if (session('message'))
                                <div
                                    class="alert alert-success alert-dismissible fade show pt-3 w-25 text-center top-50 start-50 translate-middle mt-5">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            {{-- snippet per gli errori della tabella dei tag --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form mt-5 php-email-form">
                            <div class="container my-5">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h2>Richieste per ruolo amministratore</h2>
                                        {{-- tabella per le richieste di amministratore --}}
                                        <x-requests-table :roleRequest="$adminRequests" role="amministratore" />
                                    </div>
                                </div>
                            </div>
                            <div class="container my-5 pt-3">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h2>Richieste per ruolo revisore</h2>
                                        {{-- tabella per le richieste di revisore --}}
                                        <x-requests-table :roleRequest="$revisorRequests" role="revisore" />
                                    </div>
                                </div>
                            </div>
                            <div class="container my-5 pt-3">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h2>Richieste per ruolo redattore</h2>
                                        {{-- tabella per le richieste di redattore --}}
                                        <x-requests-table :roleRequest="$writerRequests" role="redattore" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact mb-5" id="contact">
            <div class="container my-5 p-5">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mb-5" id="test">
                        <h2 class="display-4  fw-medium text-center">
                            Gestione tag e categorie
                        </h2>
                        <div class="container-fluid position-relative">
                            {{-- snippet per gli errori della tabella dei tag --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form mt-5 php-email-form">
                            {{-- inserimento nella dashboard della tabella dei tag --}}
                            <div class="container my-5 pt-3">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h2>I tag della piattaforma</h2>
                                        {{-- tabella per i tag --}}
                                        <x-metainfo-table :metaInfos="$tags" metaType="tags"/>
                                        {{$tags->links()}}


                                        {{-- form per la creazione di nuovi tag --}}
                                        <form action="{{route('admin.storeTag')}}" method="POST" class="d-flex">
                                            @csrf
                                            <input type="text" name="name" class="form-control me-2" placeholder="Inserisci un nuovo tag">
                                            <button type="submit" class="btn rounded-0">Aggiungi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- inserimento nella dashboard della tabella delle categorie --}}
                            <div class="container my-5 pt-3">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h2>Le categorie della piattaforma</h2>
                                        {{-- tabella per le categorie--}}
                                        <x-metainfo-table :metaInfos="$categories" metaType="categories" />
                                        {{-- form per la creazione di una nuova categoria --}}
                                        <form action="{{route('admin.storeCategory')}}" method="POST" class="d-flex">
                                            @csrf
                                            <input type="text" name="name" class="form-control me-2" placeholder="Inserisci una nuova categoria">
                                            <button type="submit" class="btn rounded-0">Aggiungi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-main>