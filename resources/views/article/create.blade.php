<x-main>
    <section class="contact mb-5" id="contact">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-5">
                    <h1 class="page-title text-center">
                        Scrivi Articolo
                    </h1>
                @if($errors ->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}} <button type="button" class="btn-close" data-bs-dismiss="alert"></button></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form mt-5 php-email-form" action="{{route('article.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" name="title" class="form-control"@error ('title') is-invalid @enderror id="title" value="{{old('title')}}">
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo</label>
                        <input type="text" name="subtitle" class="form-control" @error ('subtitle') is-invalid @enderror id="subtitle" value="{{old('subtitle')}}">
                    </div>
                    <div class="md-3">
                        <label for="validationCustom05" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" @error ('image') is-invalid @enderror id="validationCustom05" required>
                        <span class="small fst-italic">Caricare immagini orizzontali</span>
                    </div>
                    {{-- In questa parte, come richiesto per l'user 5 andremo a creare la parte relativa ai tag: --}}
                    <div class="md-3 mt-3">
                        <label for="tags" class="form-label">Tag</label>
                        <input type="text" name="tags" class="form-control" @error ('tag') is-invalid @enderror id="tag" value="{{old('tag')}}" required>
                        <span class="small fst-italic">Dividi ogni Tag con una virgola</span>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select type="category" name="category" class="form-control text-capitalize">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Corpo del testo</label>
                        <textarea name="body" id="body" cols="30" rows="7" class="form-control">{{old('body')}}</textarea>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="text-center">Inserisci Articolo</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-main>