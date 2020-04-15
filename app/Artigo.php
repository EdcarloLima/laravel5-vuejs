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
}
