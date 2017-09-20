<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Endereco;
use \qms\Telefone;
use \qms\Consulta;
use \qms\Especialidade;

class Medico extends Model
{
  protected $fillable = [
      'nome_medico', 'numero_crm', 'endereco_id', 'telefone_id',
  ];

  public function endereco(){
     return $this->hasOne(Endereco::class);
  }

  public function telefone(){
     return $this->hasOne(Telefone::class);
  }

  public function especialidades() {
    return $this->belongsToMany(Especialidade::class);
  }
}
