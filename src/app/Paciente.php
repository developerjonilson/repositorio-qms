<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Endereco;
use \qms\Telefone;

class Paciente extends Model
{
  protected $fillable = [
      'nome_paciente', 'sexo', 'data_nascimento', 'numero_cns',
      'nome_mae', 'nome_pai', 'endereco_id', 'telefone_id',
  ];

  public function endereco(){
     return $this->hasOne(Endereco::class);
  }

  public function telefone(){
     return $this->hasOne(Telefone::class);
  }
}
