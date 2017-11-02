<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Especialidade;
use \qms\Models\Medico;
use \qms\Consulta;
use \qms\Models\Periodo;

class Calendario extends Model
{
  protected $table = 'calendarios';

  protected $primaryKey = 'id_calendario';

  protected $fillable = [
      'data', 'especialidade_id', 'medico_id',
  ];

  public function especialidade(){
     return $this->hasOne(Especialidade::class);
  }

  public function medico(){
    return $this->belongsTo(Medico::class);
  }

  public function periodos(){
     return $this->hasMany(Periodo::class);
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }
}
