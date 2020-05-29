<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo','descricao','conteudo','data'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getDateFormatLocal(string $dateTimeLocal) : string
    {
        return str_replace_first(' ','T',$dateTimeLocal);
    }

    public function getDataBr(string $dataSql, bool $exibirHora) : string
    {
        $dataBr = '';
        $hora = '';
        if (strlen($dataSql) > 10) {
            $data = explode(' ',$dataSql);
            $hora = $data[1];
            $data = explode('-',$data[0]);
            $dataBr = $data[2].'/'.$data[1].'/'.$data[0];
        } else {
            $data = explode('-',$dataSql);
            $dataBr = $data[2].'/'.$data[1].'/'.$data[0];
        }
        return ($exibirHora) ? $dataBr.' '.$hora : $dataBr;
    }

    public function getQuantidade() : int
    {
        return $this->count();
    }

    public function listarArtigos(int $paginate)
    {
        return $this->select(['artigos.id','artigos.titulo','artigos.descricao','users.name',
            DB::raw("date_format(artigos.data,'%Y-%m-%d') as data")])
            ->join('users', 'artigos.user_id', 'users.id')
            ->whereNull('artigos.deleted_at')
            ->paginate($paginate);
    }

    public function listarArtigosSite(int $paginate)
    {
        return $this->select(['artigos.id','artigos.titulo','artigos.descricao','users.name as autor',
            DB::raw("date_format(artigos.data,'%Y-%m-%d') as data")])
            ->join('users', 'artigos.user_id', 'users.id')
            ->whereNull('artigos.deleted_at')
            ->whereDate('artigos.data','<=',date('Y-m-d'))
            ->orderByDesc('artigos.data')
            ->paginate($paginate);
    }
}
