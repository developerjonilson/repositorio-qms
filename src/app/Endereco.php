<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cidade(){
       return $this->hasOne('App\Cidade');
    }
}
