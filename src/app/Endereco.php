<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Cidade;
use \qms\User;
use \qms\Paciente;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'rua', 'numero', 'complemento', 'bairro', 'cidade_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function cidade(){
       return $this->hasOne(Cidade::class);
    }
}
