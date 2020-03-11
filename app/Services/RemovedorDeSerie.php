<?php

namespace App\Services;
use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $id): String
    {
        DB::beginTransaction();
        $serie = Serie::find($id);
        $nomeSerie = $serie->nome;
        $this->removerTemporadas($serie);
        $serie->delete();
        DB::commit();
        return $nomeSerie;
    }

    public function removerTemporadas($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });

    }

    public function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
