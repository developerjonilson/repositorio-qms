<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Especilidade;
use \qms\Medico;
use \qms\Paciente;

class Consulta extends Model
{
  protected $fillable = [
      'periodo', 'data_consulta', 'especilidade_id', 'medico_id', 'paciente_id',
  ];

  public function especilidade(){
    return $this->hasOne(Especilidade::class);
  }

  public function medico(){
    return $this->hasOne(Medico::class);
  }

  public function paciente(){
    return $this->hasOne(Paciente::class);
  }

}
