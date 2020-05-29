<template>
    <div :class="'col-sm-'+ (sm || '6') + ' col-md-' + (md || '4')">
        <div class="thumbnail">
            <img :src="imagem" :alt="alt">
            <div class="caption">
                <small>{{data | formataData}} - {{autor}}</small>
                <h3>{{titulo}}</h3>
                <p>{{descricao}}</p>
                <p><a :href="link" class="btn btn-primary" role="button">Ler mais</a></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ArtigoCard",
        props:['titulo','descricao','link','imagem','alt','data','autor','sm','md'],
        filters: {
            formataData: function (valor) {
                if (!valor) return '';
                valor = valor.toString();
                if (valor.split('-').length === 3) {
                    valor = valor.split('-');
                    return valor[2]+'/'+valor[1]+'/'+valor[0];
                }
                return valor;
            }
        }
    }
</script>

<style media="screen">

</style>