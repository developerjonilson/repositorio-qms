<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Estado;
use \qms\Endereco;

class Cidade extends Model
{
    protected $table = 'cidades';

    protected $fillable = [
        'nome_cidade', 'cep', 'estado_id',
    ];

    public function endereco(){
        return $this->belongsTo(Endereco::class);
    }

    public function estado(){
       return $this->hasOne(Estado::class);
    }

}
