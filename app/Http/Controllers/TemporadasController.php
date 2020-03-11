<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index (int $seriesId)
    {
        $serie = Serie::find($seriesId);
        $temporadas = $serie->temporadas;

        return view('temporadas.index', compact('temporadas', 'serie'));
    }
}
