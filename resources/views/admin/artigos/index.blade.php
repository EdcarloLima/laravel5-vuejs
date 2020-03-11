@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

            <tabela-lista
                    v-bind:titulos="['#','Título','Descrição']"
                    v-bind:itens="{{$listaArtigos}}"
                    ordem="asc" ordemcol="1"
                    criar="#criar" detalhe="#detalhe" editar="#editar" deletar="#deletar" token="5d5s4d5ads45a5" modal="sim"
            ></tabela-lista>
        </painel>
    </pagina>
    <modal nome="adicionar">
        <painel titulo="Adicionar">
            <formulario css="" action="#" method="put" enctype="" token="">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
                </div>
                <button class="btn btn-info">Adicionar</button>
            </formulario>
        </painel>
    </modal>
@endsection