<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Medico;
use \qms\Models\Consulta;
use \qms\Models\Calendario;

class Especialidade extends Model
{
  protected $fillable = [
      'nome_especialidade',
  ];

  public function calendario(){
    return $this->belongsTo(Calendario::class);
  }

  public function medicos() {
    return $this->belongsToMany(Medico::class);
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }
}
