<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function getQuantidade() : int
    {
        return $this->count();
    }

    public function listarArtigos(int $paginate)
    {
        return $this->select(['artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data'])
            ->join('users', 'artigos.user_id', 'users.id')
            ->whereNull('artigos.deleted_at')
            ->paginate($paginate);
    }

    public function listarArtigosSite(int $paginate)
    {
        return $this->select(['artigos.id','artigos.titulo','artigos.descricao','users.name as autor','artigos.data'])
            ->join('users', 'artigos.user_id', 'users.id')
            ->whereNull('artigos.deleted_at')
            ->whereDate('artigos.data','<=',date('Y-m-d'))
            ->orderByDesc('artigos.data')
            ->paginate($paginate);
    }
}
