<?php

namespace App\Http\Controllers\Site;

use App\Artigo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SiteController extends Controller
{
    public function index()
    {
        $artigo = new Artigo();
        $lista = $artigo->listarArtigosSite(3);
        return response()->view('site',compact('lista'));
    }
}