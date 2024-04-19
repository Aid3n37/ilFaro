{{-- L'utente loggato deve poter scegliere il ruolo per cui candidarsi 
-->admin
-->revisor
-->writer
--}}

{{-- Dobbiamo creare un form con all'interno tre input principali 
1) In cui l'utente può scegliere il ruolo per cui fare richiesta
2)Per la mail precompilata 
3)Messaggio di presentazione da mandare al revisore --}}

<x-main>
    @guest
        
    @endguest
    <section class="contact mb-5" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-5">
                    <h1 class="page-title text-center">
                        Lavora Con Noi
                    </h1>
                    <div  class="form mt-5 php-email-form">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-md-6">
                                <h2 class="pb-1">Lavora Come Amministratore</h2>
                                <p>Guida l'efficienza, promuovi l'integrità. 
                                    Il Faro è alla ricerca di un amministratore per mantenere la nostra missione di verità.
                                    Unisciti a noi per illuminare il cammino della trasparenza e dell'eccellenza.</p>

                                <h2 class="pb-1">Lavora Come Revisore</h2>
                                <p>Sei il custode della verità? Il Faro, il nostro giornale, 
                                    cerca revisori rigorosi per garantire la veridicità dei contenuti. 
                                    Sei pronto a far risplendere la luce della precisione?</p>

                                <h2 class="pb-1">Lavora Come Redattore</h2>
                                <p>Scrivere la verità è la tua passione? 
                                    Il Faro, dove la veridicità è fondamentale, 
                                    sta cercando redattori creativi per condividere storie autentiche e rivelatrici. 
                                    Unisciti a noi per illuminare le menti dei nostri lettori.</p>

                            </div>

                            {{-- GESTIONE DEGLI ERRORI AUTOMATICA --}}
                            <div class="col-12 col-md-6">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{-- FINE GESTIONE ERRORI --}}

                                {{-- CREAZIONE DEL FORM --}}
                                {{-- Nella action siamo a richiamare la rotta post del form --}}
                                <form action="{{ route('careers.submit') }}" method="POST" class="p-5">
                                    {{-- TOKEN --}}
                                    @csrf

                                    {{-- Adesso creeremo la prima label per la scelta di candidatura --}}
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Per quale ruolo ti stai
                                            candidando?</label>
                                        <select name="role" id="role" class="form-control">
                                            {{-- In questo modo vado a gestire le seguenti casistiche:
                                            Se l'utente è amministratore stampami revisore e redattore;
                                            Se l'utente è redattore stampami solamente revisore e amministratore;
                                            Se l'utente è revisore stampami solamente amministratore e redattore;
                                            Mentre, nel caso in cui l'utente fosse sia un revisore che un amministratore stampami solamente redattore. --}}
                                            @switch(true)

                                            @case(Auth::user()->is_revisor && Auth::user()->is_admin)
                                                <option value="writer">Redattore</option>
                                                @break

                                                @case(Auth::user()->is_revisor && Auth::user()->is_writer)
                                                <option value="writer">Amministratore</option>
                                                @break

                                                @case(Auth::user()->is_writer && Auth::user()->is_admin)
                                                <option value="writer">Revisore</option>
                                                @break

                                                @case(Auth::user()->is_writer && Auth::user()->is_revisor)
                                                <option value="writer">Amministratore</option>
                                                @break
                                                
                                                @case(Auth::user()->is_admin && Auth::user()->is_revisor)
                                                <option value="writer">Redattore</option>
                                                @break

                                                @case(Auth::user()->is_admin && Auth::user()->is_writer)
                                                <option value="writer">Revisore</option>
                                                @break
                                                
                                                @case(Auth::user()->is_revisor)
                                                <option value="admin">Amministratore</option>
                                                <option value="writer">Redattore</option>
                                                @break
                                    
                                            @case(Auth::user()->is_admin)
                                                <option value="revisor">Revisore</option>
                                                <option value="writer">Redattore</option>
                                                @break
                                    
                                            @case(Auth::user()->is_writer)
                                                <option value="revisor">Revisore</option>
                                                <option value="admin">Amministratore</option>
                                                @break
                                                                       
                                            @default
                                                <option value="admin">Amministratore</option>
                                                <option value="writer">Redattore</option>
                                                <option value="revisor">Revisore</option>
                                        @endswitch
                                    </select>

                                       
                                    </div>


                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        {{-- All'interno del campo input di tipo email inseriamo il value in modo che il dato rimanga salvato anche in caso di errore 
                        e nel caso l'utente fosse gia autenticato ci prediamo direttamente la sua email --}}
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ old('email') ?? Auth::user()->email }}">
                                    </div>


                                    <div class="mb-3">
                                        {{-- Adesso creiamo la label per scrivere il messaggio di candidatura e la label per il bottone della candidatura --}}
                                        <label for="message" class="form-label">Parlaci di te!</label>
                                        <textarea name="message" id="message" cols="30" rows="7" class="form-control">{{ old('message') }}</textarea>
                                    </div>


                                    {{-- Creazione del bottone --}}
                                    <div class="mt-2">
                                        <button type="submit" class="text-center">Invia la tua
                                            candidatura</button>
                                    </div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>