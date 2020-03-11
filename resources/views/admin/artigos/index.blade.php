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
    <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="#" method="put" enctype="" token="">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
        </span>
    </modal>

    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" css="" action="#" method="put" enctype="multipart/form-data" token="123456">
            <div class="form-group">
                <label for="ed-titulo">Título</label>
                <input type="text" class="form-control" id="ed-titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="ed-descricao">Descrição</label>
                <input type="text" class="form-control" id="ed-descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Editar</button>
        </span>
    </modal>

    <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
        <p>@{{$store.state.item.descricao}}</p>
    </modal>
@endsection