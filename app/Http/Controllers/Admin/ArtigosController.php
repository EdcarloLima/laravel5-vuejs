<?php

namespace App\Http\Controllers\Admin;

use App\Artigo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Admin", "url" => route('admin')],
            ["titulo" => "Lista de Artigos", "url" => ""]
        ]);
        $artigo = new Artigo();
        /*$user = new User();
        $listaArtigos = $artigo->select(['id','titulo','descricao','user_id','data'])->paginate(5);
        foreach ($listaArtigos as $art) {
            $art->user_id = $user->getNome($art->user_id);
        }*/
        $listaArtigos = $artigo->listarArtigos(5);
        return response()->view('admin.artigos.index', compact('listaMigalhas','listaArtigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $validacao = \Validator::make($dados,[
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required",
        ]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $user = auth()->user();
        $user->artigos()->create($dados);

        return response()->redirectToRoute('artigos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $art = new Artigo();
        $artigo = $art->find($id);
        $artigo->data = $art->getDate($artigo->data);
        return $artigo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $validacao = \Validator::make($dados,[
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required",
        ]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        $user = auth()->user();
        $user->artigos()->find($id)->update($dados);
        return response()->redirectToRoute('artigos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artigo = new Artigo();
        $artigo->find($id)->delete();
        return response()->redirectToRoute('artigos.index');
    }
}
