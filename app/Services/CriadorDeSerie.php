<?php


namespace App\Services;


use App\Serie;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(String $nomeDaSerie, int $qtdTemporadas, int $qtdEpisodios)
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeDaSerie]);
        $this->criaTemporadas($qtdTemporadas, $serie, $qtdEpisodios);
        DB::commit();

        return $serie;
    }

    public function criaTemporadas(int $qtdTemporadas, $serie, int $qtdEpisodios): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($qtdEpisodios, $temporada);
        }
    }

    public function criaEpisodios(int $qtdEpisodios, $temporada): void
    {
        for ($j = 1; $j <= $qtdEpisodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        };
    }
}
