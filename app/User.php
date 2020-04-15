<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','autor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //protected $dates = ['deleted_at'];

    public function artigos()
    {
        return $this->hasMany('App\Artigo');
    }

    public function getNome(int $userId) : string
    {
        $select = $this->select('name')->where('id', $userId)->first();
        return (!empty($select)) ? $select->name : '';
    }
}
