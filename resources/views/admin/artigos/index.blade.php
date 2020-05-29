@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        @if ($errors->all())
            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @foreach($errors->all() as $key => $value)
                    <li>{{$value}}</li>
                @endforeach
            </div>
        @endif
        <painel titulo="Lista de Artigos">
            <migalhas :lista="{{$listaMigalhas}}"></migalhas>
            <tabela-lista
                    :titulos="['#','Título','Descrição','Autor','Data']"
                    :itens="{{json_encode($listaArtigos)}}"
                    ordem="desc" ordemcol="0"
                    criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{csrf_token()}}" modal="sim"
            ></tabela-lista>
            <div align="center">
                {{$listaArtigos->links()}}
            </div>
        </painel>
    </pagina>

    <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
            </div>
            <div class="form-group">
                <label for="addConteudo">Conteúdo</label>
                <ckeditor
                        id="addConteudo"
                        name="conteudo"
                        value="{{old('conteudo')}}"
                        :config="{ toolbar: [
                                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                                    ],
                                    height: 200
                                 }">
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
        </span>
    </modal>

    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" :action="'/admin/artigos/'+$store.state.item.id" method="put" enctype="" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="ed-titulo">Título</label>
                <input type="text" class="form-control" id="ed-titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="ed-descricao">Descrição</label>
                <input type="text" class="form-control" id="ed-descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <label for="editConteudo">Conteúdo</label>
                <ckeditor
                        id="editConteudo"
                        name="conteudo"
                        v-model="$store.state.item.conteudo"
                        :config="{ toolbar: [
                                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                                    ],
                                    height: 200
                                 }">
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="editData">Data</label>
                <input type="date" class="form-control" id="editData" name="data" v-model="$store.state.item.data">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Editar</button>
        </span>
    </modal>

    <modal nome="detalhe" :titulo="$store.state.item.titulo">
        <p>@{{$store.state.item.descricao}}</p>
        <p>@{{$store.state.item.conteudo}}</p>
    </modal>
@endsection