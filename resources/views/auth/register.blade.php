<x-main>
    <section class="contact mb-5" id="contact">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-5">
                    <h1 class="page-title text-center">
                        Registrati
                    </h1>
                    {{-- GESTIONE DEGLI ERRORI --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="form mt-5 php-email-form" action="{{route('register')}}" method="POST">
                        {{-- TOKEN --}}
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome utente</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email utente</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password"  required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Conferma password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                required>
                        </div>
    
                        <button type="submit" class="text-center">Registrati</button>
                        <a href="{{route('login')}}" class="ms-3 text-center btn-outline-dark">Gia' iscritto?</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-main>