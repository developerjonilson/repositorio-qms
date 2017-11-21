<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Medico;
use \qms\Models\Consulta;
use \qms\Models\Calendario;

class Especialidade extends Model
{
  protected $table = 'especialidades';

  protected $primaryKey = 'id_especialidade';

  protected $fillable = [
      'codigo_especialidade', 'nome_especialidade',
  ];

  public function calendario(){
    return $this->belongsTo(Calendario::class);
  }

  public function medicos() {
    return $this->belongsToMany(Medico::class, 'especialidade_medico', 'id_especialidade', 'id_medico');
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }
}
