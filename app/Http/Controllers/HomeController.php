<?php

namespace App\Http\Controllers;

use App\Artigo;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
            ["titulo" => "Home", "url" => ""]
        ]);
        $artigo = new Artigo();
        $usuario = new User();
        $qtdUsuarios = $usuario->count();
        $qtdAutores = $usuario->where('autor','S')->count();
        $qtdArtigos = $artigo->getQuantidade();
        return response()->view('home', compact('listaMigalhas','qtdUsuarios','qtdAutores','qtdArtigos'));
    }
}
