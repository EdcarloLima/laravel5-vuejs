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

    public function getDate(string $dataSql) : string
    {
        $data = '';
        if (strlen($dataSql) > 10) {
            $dt = explode(' ', $dataSql);
            $data = $dt[0];
        } else
            $data = $dataSql;
        return $data;
    }

    public function getQuantidade() : int
    {
        return $this->count();
    }

    public function listarArtigos(int $paginate)
    {
        $user = auth()->user();
        $select = $this->select(['artigos.id','artigos.titulo','artigos.descricao','users.name',
            DB::raw("date_format(artigos.data,'%Y-%m-%d') as data")])
            ->join('users', 'artigos.user_id', 'users.id')
            ->whereNull('artigos.deleted_at');
        if ($user->admin == 'N')
            $select->where('artigos.user_id',$user->id);

        return $select->orderByDesc('artigos.id')
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

    public function buscarArtigosSite(string $busca, int $paginate)
    {
        return $this->select(['artigos.id','artigos.titulo','artigos.descricao','users.name as autor',
            DB::raw("date_format(artigos.data,'%Y-%m-%d') as data")])
            ->join('users', 'artigos.user_id', 'users.id')
            ->whereNull('artigos.deleted_at')
            ->whereDate('artigos.data','<=',date('Y-m-d'))
            ->where(function ($query) use ($busca){
                $query->orWhere('artigos.titulo','like',"%$busca%")->orWhere('artigos.descricao','like',"%$busca%");
            })
            ->orderByDesc('artigos.data')
            ->paginate($paginate);
    }
}
