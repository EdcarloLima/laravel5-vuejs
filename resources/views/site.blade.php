@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Artigos">
            <div class="row">
                @foreach($lista as $key => $value)
                    <artigocard
                    titulo="{{str_limit($value->titulo,25,'...')}}"
                    descricao="{{str_limit($value->descricao,40,'...')}}"
                    data="{{$value->data}}"
                    autor="{{$value->autor}}"
                    imagem="{{asset('img/coffee-dev.jpg')}}"
                    alt="Transformando café em código"
                    link="{{route('artigo',[$value->id,str_slug($value->titulo)])}}"
                    sm="6"
                    md="4"
                    >

                    </artigocard>
                @endforeach
            </div>
            <div align="center">
                {{$lista}}
            </div>
        </painel>
    </pagina>
@endsection
