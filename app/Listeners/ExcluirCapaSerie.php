<?php

namespace App\Listeners;

use App\Events\serieApagada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaSerie implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  serieApagada  $event
     * @return void
     */
    public function handle(serieApagada $event)
    {
        $serie = $event->serie;
        if ($serie->capa)
        {
            Storage::delete($serie->capa);
        }
    }
}
