<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';

    public function endereco(){
        return $this->belongsTo('App\Endereco');
    }

    public function estado(){
       return $this->hasOne('App\Estado');
    }

}
