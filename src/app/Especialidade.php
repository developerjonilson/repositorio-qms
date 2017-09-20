<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Medico;
use \qms\Consulta;

class Especialidade extends Model
{
  protected $fillable = [
      'nome_especialidade',
  ];

  public function consulta() {
      return $this->belongsTo(Consulta::class);
  }

  public function medicos() {
    return $this->belongsToMany(Medico::class);
  }
}
