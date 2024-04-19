{{-- componente che rappresenta ciascuna tabella dei differrenti ruoli --}}
{{-- è uguale per tutti gli elementi che la richiamano, ma adattiva sulla base dei dati che riceve --}}
<div class="table-responsive">
    <table class="table table-striped table-hover border ">
        <thead class="table-dark">
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    Nome
                </th>
                <th scope="col">
                    Email
                </th>
                <th scope="col" class="text-center">
                    Azione
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roleRequest as $user)
                <tr>
                    <td scope="row" class="pe-3 pt-3">{{ $user->id }}</td>
                    <td class="pe-3 pt-3">
                        {{ $user->name }}
                    </td>
                    <td class="pe-3 pt-3">
                        {{ $user->email }}
                    </td>
                        <td>
                            {{-- l'utente admin in questo modo può vedere le richieste degli user per i vari ruoli 
                        e decidere se attribuirglielo o meno --}}
                            {{-- usando un switch case facilità la separazione delle richieste e quindi approvazioni --}}
                            @switch($role)
                                @case('amministratore')
                                    <form action="{{ route('admin.setAdmin', compact('user')) }}" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="text-center">Attiva {{ $role }}</button>
                                    </form>
                                @break
                                @case('revisore')
                                    <form action="{{ route('admin.setRevisor', compact('user')) }}" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="text-center">Attiva {{ $role }}</button>
                                    </form>
                                @break

                                @case('redattore')
                                    <form action="{{ route('admin.setWriter', compact('user')) }}" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="text-center">Attiva {{ $role }}</button>
                                    </form>
                                @break
                            @endswitch
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
