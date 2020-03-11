@extends('layout')

@section('cabeçalho')
    Adicionar série
@endsection

@section('conteudo')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="post" id="formAdd">
        @csrf
        <div class="row">
            <div class="col col-8">
                <input type="text" class="form-control" name="nome" placeholder="Título da série">
            </div>

            <div class="col col-2">
                <input type="number" class="form-control" name="qtd_temporadas" placeholder="nº de temporadas">
            </div>

            <div class="col col-2">
                <input type="number" class="form-control" name="qtd_episodios" placeholder="Ep por temporada">
            </div>

        </div>

        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-info">Adicionar</button>
            </div>
        </div>


    </form>
@endsection


