<?php

Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
            ->middleware('Autenticador');
Route::post('/series/criar', 'SeriesController@store')
    ->middleware('Autenticador');
Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('Autenticador');
Route::post('/series/{id}/editarNome', 'SeriesController@editaNome')
    ->middleware('Autenticador');

Route::get('/series/{seriesId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index' );
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir' )
    ->middleware('Autenticador');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});

Route::get('/visualizando-email', function (){
    return new \App\Mail\NovaSerie(
        'Arrow',
        5,
        10
    );
});

Route::get('/enviando-email', function (){


    $user = (object)[
        'email' => 'joao@teste.com.br',
        'name' => 'João Paulo'
    ];

    return 'Email enviado';
});
