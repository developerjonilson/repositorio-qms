<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Calendario;
use \qms\Models\Periodo;
use \qms\Models\Paciente;
use \qms\Models\Especilidade;
use \qms\Models\Medico;
use \qms\Models\Local;

class Consulta extends Model
{
  protected $table = 'consultas';

  protected $primaryKey = 'id_consulta';

  protected $fillable = [
    'codigo_consulta', 'calendario_id', 'periodo_id', 'paciente_id',
    'especilidade_id', 'medico_id',  'local_id',
  ];
  public function calendario(){
    return $this->hasOne(Calendario::class);
  }

  public function periodo(){
    return $this->hasOne(Periodo::class);
  }

  public function paciente(){
    return $this->hasOne(Paciente::class);
  }

  public function especilidade(){
    return $this->hasOne(Especilidade::class);
  }

  public function medico(){
    return $this->hasOne(Medico::class);
  }

  public function local(){
    return $this->hasOne(Local::class);
  }

}
