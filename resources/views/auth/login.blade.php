<x-main>
    <section class="contact mb-5" id="contact">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-5">
                    <h1 class="page-title text-center">
                        Accedi
                    </h1>
            {{-- utiliziamo sempre il solito ciclo per contorllare gli errori --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
    
                    <form class="form mt-5 php-email-form" action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email utente</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
    
                        <button type="submit" class="text-center">Accedi</button>
                        <a href="{{route('register')}}" class="ms-3 text-center btn-outline-dark ">Non sei registrato?</a>
              {{-- Nel caso un utente non fosse registrato lo indirizziamo alla rotta register --}}
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-main>