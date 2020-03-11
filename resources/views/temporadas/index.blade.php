@extends('layout')

@section('cabeçalho')
    Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')

    <ul class="list-group list-group-flush">
        @foreach($temporadas as $temporada)
            <li class="list-group-item">
                Temporada {{ $temporada->numero }}
            </li>
        @endforeach
    </ul>



@endsection

