@extends('layout')

@section('cabeçalho')
    Séries
@endsection

@section('conteudo')

    @if(!empty($mensagem))
        <div class="alert alert-success mb-2 p-2" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col">
            <a href="/series/criar" class="btn btn-info" role="button">Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="list-group list-group-flush">
                @foreach($series as $serie)

                    <li class="list-group-item d-flex align-items-center justify-content-between">

                        <input id="inputSerie-{{ $serie->id }}" class="form-control mr-2" type="text"
                               value="{{ $serie->nome }}" readonly>

                        <button onclick="editSerie({{ $serie->id }})" class="btn btn-info btn-sm mr-2"
                                style="visibility: hidden; display: none" id="editButton-{{ $serie->id }}">
                            <i class="tiny material-icons">done</i>
                        </button>
                        @csrf

                        <div class="d-flex">

                            <button class="btn btn-success btn-sm mr-2" onclick="toggleEdit({{ $serie->id }})">
                                <i class="tiny material-icons">edit</i>
                            </button>

                            <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-2">
                                <i class="tiny material-icons">link</i>
                            </a>

                            <form method="post" action="/series/{{$serie->id}}"
                                  onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    <i class="tiny material-icons">delete_forever</i>
                                </button>
                            </form>
                        </div>

                    </li>

                @endforeach
            </ul>
        </div>
    </div>

    <script>

        function toggleEdit(idSerie) {
            const inputSerie = document.getElementById('inputSerie-' + idSerie);
            const editButton = document.getElementById('editButton-' + idSerie);

            if (inputSerie.readOnly === true) {
                inputSerie.readOnly = false;
                editButton.style.visibility = 'visible';
                editButton.style.display = 'block'
            } else {
                inputSerie.readOnly = true;
                editButton.style.visibility = 'hidden';
                editButton.style.display = 'none'
            }
        }

        function editSerie(idSerie) {
            const url = `/series/${idSerie}`;
            const token = document.querySelector('input[name="_token"]').value;
            const inputSerie = document.getElementById('inputSerie-' + idSerie);

            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    nome: inputSerie.value
                }),
                method: 'POST'
            }).then(() => {
                toggleEdit(idSerie);
            });
        }


    </script>
@endsection
