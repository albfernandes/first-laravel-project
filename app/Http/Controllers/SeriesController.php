<?php


namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index (Request $request)
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()
            ->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }


    public function create ()
    {
        return view('series.create');
    }


    public function store (SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->qtd_episodios);
        $request->session()
            ->flash('mensagem', "Série {$serie->nome} inserida com sucesso! Com {$request->qtd_temporadas} temporadas e {$request->qtd_episodios} episódios");
        return redirect('/series');
    }


    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()
            ->flash('mensagem', "Série {$nomeSerie} removida com sucesso!");
        return redirect('/series');

    }

    public function editarNome(Request $request)
    {
        $serie = Serie::find($request->id);
        $serie->nome = json_decode($request->getContent())->nome;
        $serie->save();
        return $serie;
    }
}


