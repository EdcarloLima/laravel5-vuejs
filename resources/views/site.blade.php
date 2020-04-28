@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Artigos">
            <div class="row">
                <artigocard
                titulo="Primeira publicação"
                descricao="Novidades em primeira mão do mundo dos devs"
                data="10/04/2020"
                autor="Edcarlo Lima"
                imagem="{{asset('img/coffee-dev.jpg')}}"
                alt="Transformando café em código"
                link=""
                sm="6"
                md="4"
                >

                </artigocard>
            </div>
        </painel>
    </pagina>
@endsection
