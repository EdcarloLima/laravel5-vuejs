<template>
    <div>
        <a href="#">Criar</a>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Autor</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Primeiro Artigo</td>
                <td>Artigo sobre alguma coisa</td>
                <td>Carlos Alberto</td>
                <td>12/03/2020</td>
                <td>
                    <a href="#">Editar</a> |
                    <a href="#">Deletar</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Segundo Artigo</td>
                <td>Artigo sobre outra coisa</td>
                <td>Carlos Alberto</td>
                <td>14/03/2020</td>
                <td>
                    <a href="#">Editar</a> |
                    <a href="#">Deletar</a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Terceiro Artigo</td>
                <td>Artigo sobre novidades</td>
                <td>Carlos Alberto</td>
                <td>15/03/2020</td>
                <td>
                    <a href="#">Editar</a> |
                    <a href="#">Deletar</a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Quarto Artigo</td>
                <td>Artigo sobre tecnologia</td>
                <td>Carlos Alberto</td>
                <td>16/03/2020</td>
                <td>
                    <a href="#">Editar</a> |
                    <a href="#">Deletar</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "TabelaLista"
    }
</script>

<style media="screen">

</style>