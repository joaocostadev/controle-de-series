<?php

namespace App\Services;

use App\Episodio;
use App\Events\serieApagada;
use App\Jobs\excluirCapaSerie as excluirCapaSerieAlias;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemoverdorDeSerie
{
    public function removerSerie(int $serieId) : string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie){
            $serie = Serie::find($serieId);
            $serieObj = (object) $serie->toArray();
            $nomeSerie = $serie->nome;
            $this->removerTemporadas($serie);
            $serie->delete();

            $evento = new serieApagada($serieObj);
            event($evento);
            excluirCapaSerieAlias::dispatch($serieObj);
        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     * @return void
     * @throws \Exception
     */
    private function removerTemporadas($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     * @return void
     * @throws \Exception
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
