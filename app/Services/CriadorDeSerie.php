<?php

namespace App\Services;

use App\Serie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada, ?string $capa) :Serie
    {
        DB::beginTransaction();
        $serie = Serie::create([
            'nome' => $nomeSerie,
            'capa' => $capa]);
        $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();

        return $serie;
    }

    public function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie) :void
    {
        $qtdTemporadas = $qtdTemporadas;
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    public function criaEpisodios(int $epPorTemporada, Model $temporada) : void
    {
        for($j = 1; $j <= $epPorTemporada; $j++){
            $episodio = $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
