<?php

namespace App\Http\Controllers;

use App\Artigo;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Admin", "url" => ""]
        ]);
        $artigo = new Artigo();
        $usuario = new User();
        $qtdUsuarios = $usuario->count();
        $qtdAutores = $usuario->where('autor','S')->count();
        $qtdArtigos = $artigo->getQuantidade();
        return response()->view('admin', compact('listaMigalhas','qtdUsuarios','qtdAutores','qtdArtigos'));
    }
}
