<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Endereco;
use \qms\Models\Telefone;
use \qms\Models\Consulta;

class Paciente extends Model
{
  protected $fillable = [
      'nome_paciente', 'sexo', 'data_nascimento', 'numero_cns', 'cpf', 'rg',
      'nome_mae', 'nome_pai', 'endereco_id', 'telefone_id',
  ];

  public function endereco(){
     return $this->hasOne(Endereco::class);
  }

  public function telefone(){
     return $this->hasOne(Telefone::class);
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }
}
