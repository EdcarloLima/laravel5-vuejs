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

    public function artigoDetalhes(int $id, string $titulo = null)
    {
        $art = new Artigo();
        $artigo = $art->find($id);
        if (!empty($artigo)) {
            $artigo->data = $art->getDataBr($artigo->data,false);
            return response()->view('artigo', compact('artigo'));
        }

        return response()->redirectToRoute('site');
    }
}