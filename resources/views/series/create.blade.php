@extends('layout')

@section('cabecalho')
    Adicionar Serie
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="nome" class="label-">Nome</label>
                <input type="text" class="form-control" name="nome">
            </div>

            <div class="col col-2">
                <label for="qtd_temporadas" class="label-">N. de Temporadas</label>
                <input type="number" class="form-control" name="qtd_temporadas">
            </div>

            <div class="col col-2">
                <label for="ep_por_temporada" class="label-">Ep. por Temporadas</label>
                <input type="number" class="form-control" name="ep_por_temporada">
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <label for="capa" class="label-">Capa</label>
            <input type="file" class="form-control" name="capa">
            </div>
        </div>
        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection
