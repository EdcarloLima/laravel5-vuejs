<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Home", "url" => route('home')],
            ["titulo" => "Lista de Autores", "url" => ""]
        ]);
        $usuario = new User();
        $listaAutores = $usuario->select('id','name','email')->where('autor','S')->paginate(5);
        return response()->view('admin.autores.index', compact('listaMigalhas','listaAutores'));
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
        $usuario = new User();
        $dados = $request->all();
        $validacao = \Validator::make($dados,[
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6",
        ]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        $dados['password'] = bcrypt($dados['password']);
        $usuario->create($dados);
        return response()->redirectToRoute('autores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = new User();
        return $usuario->find($id);
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
        $usuario = new User();
        $dados = $request->all();
        if (isset($dados['password']) and !empty($dados['password'])) {
            $validacao = \Validator::make($dados,[
                "name" => "required|string|max:255",
                "email" => ["required","string","email","max:255",Rule::unique('users')->ignore($id)],
                "password" => "required|string|min:6",
            ]);
            $dados['password'] = bcrypt($dados['password']);
        } else {
            $validacao = \Validator::make($dados,[
                "name" => "required|string|max:255",
                "email" => ["required","string","email","max:255",Rule::unique('users')->ignore($id)]
            ]);
            unset($dados['password']);
        }

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        $usuario->find($id)->update($dados);
        return response()->redirectToRoute('autores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = new User();
        $usuario->find($id)->delete();
        return response()->redirectToRoute('autores.index');
    }
}
